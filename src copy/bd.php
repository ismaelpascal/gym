<?php
// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$password = "";
$base_de_datos = "gym";

$conn = new mysqli($host, $usuario, $password, $base_de_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Capturar datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fechaNac'];
$telefono = $_POST['telefono'];
$domicilio = $_POST['domicilio'];

// Insertar en MySQL
$sql = "INSERT INTO usuarios (nombre, apellido, dni, fecha_nacimiento, domicilio, telefono) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nombre, $apellido, $dni, $fecha_nacimiento, $domicilio, $telefono);

if ($stmt->execute()) {
    echo "Usuario guardado correctamente en la base de datos.<br>";
} else {
    echo "Error al guardar el usuario: " . $stmt->error;
}

$stmt->close();
$conn->close();

// --- Guardar también en archivo JSON opcional ---
$archivo = "usuarios.json";  // definimos el archivo

$datos = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

$datos[] = [
    "nombre" => $nombre,
    "apellido" => $apellido,
    "dni" => $dni,
    "fechaNac" => $fecha_nacimiento,
    "telefono" => $telefono,
    "domicilio" => $domicilio
];
file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT));

echo "Cliente guardado correctamente en el archivo JSON.";
?>