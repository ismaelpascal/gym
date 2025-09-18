<?php
$host = "localhost";
$usuario = "root";
$password = "";
$base_de_datos = "gym";

$conn = new mysqli($host, $usuario, $password, $base_de_datos);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre']; // Capturar datos del formulario
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fechaNac'];
$telefono = $_POST['telefono'];
$domicilio = $_POST['domicilio'];

$sql_check = "SELECT dni FROM usuarios WHERE dni = ?"; // Verificar si usuario ya existe
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $dni);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // Usuario existe: hacemos UPDATE
    $sql = "UPDATE usuarios SET nombre=?, apellido=?, fecha_nacimiento=?, domicilio=?, telefono=? WHERE dni=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $fecha_nacimiento, $domicilio, $telefono, $dni);
} else {
    // Usuario no existe: hacemos INSERT
    $sql = "INSERT INTO usuarios (nombre, apellido, dni, fecha_nacimiento, domicilio, telefono) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $dni, $fecha_nacimiento, $domicilio, $telefono);
}

if ($stmt->execute()) {
    echo "Usuario guardado correctamente en la base de datos.<br>";
} else {
    echo "Error al guardar el usuario: " . $stmt->error;
}
$stmt->close();

$sql_pago = "SELECT fecha_pago FROM pagos WHERE dni = ? ORDER BY fecha_pago DESC LIMIT 1";
$stmt_pago = $conn->prepare($sql_pago); // Verificar pagos para determinar inactividad
$stmt_pago->bind_param("s", $dni);
$stmt_pago->execute();
$result_pago = $stmt_pago->get_result();

$es_inactivo = false;
$fecha_ultimo_pago = null;
$fecha_inactivacion = null;

if ($row = $result_pago->fetch_assoc()) {
    $fecha_ultimo_pago = $row['fecha_pago'];
    $dias_sin_pago = (strtotime(date('Y-m-d')) - strtotime($fecha_ultimo_pago)) / (60 * 60 * 24);
    if ($dias_sin_pago > 30) {
        $es_inactivo = true;
        $fecha_inactivacion = date('Y-m-d');
    }
} else {
    $es_inactivo = true;   // Nunca pagó → inactivo
    $fecha_ultimo_pago = null;
    $fecha_inactivacion = date('Y-m-d');
}
$stmt_pago->close();

// Actualizar tabla usuarios_inactivos:
// Primero eliminar si existe el registro para ese dni
$sql_del = "DELETE FROM usuarios_inactivos WHERE dni = ?";
$stmt_del = $conn->prepare($sql_del);
$stmt_del->bind_param("s", $dni);
$stmt_del->execute();
$stmt_del->close();

if ($es_inactivo) { // Si está inactivo, insertar nuevo registro
    $sql_inactivo = "INSERT INTO usuarios_inactivos (dni, fecha_ultimo_pago, fecha_inactivacion) VALUES (?, ?, ?)";
    $stmt_inactivo = $conn->prepare($sql_inactivo);
    $stmt_inactivo->bind_param("sss", $dni, $fecha_ultimo_pago, $fecha_inactivacion);
    $stmt_inactivo->execute();
    $stmt_inactivo->close();
}

// Generar JSON normalizado con todas las tablas
// Obtener todos los usuarios
$usuarios = [];
$result = $conn->query("SELECT dni, nombre, apellido, fecha_nacimiento, domicilio, telefono FROM usuarios");
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

$pagos = []; // Obtener todos los pagos
$result = $conn->query("SELECT id_pago, dni, monto, fecha_pago, metodo_pago FROM pagos");
while ($row = $result->fetch_assoc()) {
    $pagos[] = $row;
}

$usuarios_inactivos = []; // Obtener usuarios_inactivos
$result = $conn->query("SELECT dni, fecha_ultimo_pago, fecha_inactivacion FROM usuarios_inactivos");
while ($row = $result->fetch_assoc()) {
    $usuarios_inactivos[] = $row;
}

$datos_completos = [
    "usuarios" => $usuarios,
    "pagos" => $pagos,
    "usuarios_inactivos" => $usuarios_inactivos
];

$archivo = __DIR__ . "/../../public/data/usuarios.json";
file_put_contents($archivo, json_encode($datos_completos, JSON_PRETTY_PRINT));

echo "Cliente guardado correctamente en el archivo JSON.";
$conn->close();
?>