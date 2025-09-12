<?php
$host = "localhost";
$usuario = "root";
$password = "";
$base_de_datos = "gym";

$conn = new mysqli($host, $usuario, $password, $base_de_datos); //se crea la conexión con new mysqli. 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); //si la conexión falla (connect_error), detiene el script y muestra el error con die().
}

$mensaje = "";//inicializo una variable $mensaje para mostrar mensajes en la página (éxito o error).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {//verifica si el formulario fue enviado usando el método POST.
    $usuario_id = isset($_POST['usuario_id']) ? (int)$_POST['usuario_id'] : null; //usuario_id: si existe, se convierte a entero.
    $fecha_pago = $_POST['fecha_pago'] ?? null;//fecha_pago: si existe, se toma, si no, null.
    $monto = isset($_POST['monto']) ? (float)$_POST['monto'] : null;//monto: si existe, se convierte a número decimal (float)

    if ($usuario_id && $fecha_pago && $monto) {//Si los tres valores existen (no son null ni falsos), se hace lo siguiente:
        $sql = "INSERT INTO historial_pagos (usuario_id, fecha_pago, monto) VALUES (?, ?, ?)";//consulta SQL para insertar el pago en la tabla historial_pagos.
        $stmt = $conn->prepare($sql);//“Prepará esta consulta SQL ($sql) y guardala como un objeto en $stmt(statement) para poder usarla después.”
        $stmt->bind_param("isd", $usuario_id, $fecha_pago, $monto);//enlaza parámetros:"i" entero (usuario_id), "s" string (fecha_pago), "d" decimal (monto).
        if ($stmt->execute()) {//execute() ejecuta la consulta que preparaste, PHP le manda la orden a MySQL para que se inserte el pago en la base de datos.
            $mensaje = "Pago registrado correctamente.";
        } else {
            $mensaje = "Error al registrar el pago: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensaje = "Por favor completa todos los campos.";
    }
}

$result_usuarios = $conn->query("SELECT id, nombre, apellido FROM usuarios ORDER BY apellido, nombre");//consulta para traer la lista de usuarios (clientes) desde la tabla usuarios.
$usuarios = [];//se guarda el resultado en $usuarios como un array asociativo con sus datos.
if ($result_usuarios) {
    while ($row = $result_usuarios->fetch_assoc()) {//fetch_assoc() método que extrae una fila del resultado como un array asociativo.
        $usuarios[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar Pago</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-100/20 font-sans flex h-screen">

<?php include '../src/components/sideBar.php'; ?> <!--Incluye un archivo externo con el menú lateral (sidebar)-->

<main class="flex-grow p-8 max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Registrar Pago</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="mb-4 p-3 rounded text-white <?= strpos($mensaje, 'Error') === false ? 'bg-green-600' : 'bg-red-600' ?>">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-6"> <!--Campo desplegable para elegir un cliente.
                                                                                Los usuarios cargados se listan con sus apellidos y nombres. -->
        <div>
            <label for="usuario_id" class="block text-gray-700 font-medium mb-2">Cliente</label>
            <select id="usuario_id" name="usuario_id" required class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="" disabled selected>Selecciona un cliente</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>">
                        <?= htmlspecialchars($usuario['apellido'] . ', ' . $usuario['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="fecha_pago" class="block text-gray-700 font-medium mb-2">Fecha de Pago</label>
            <input type="date" id="fecha_pago" name="fecha_pago" required class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <div>
            <label for="monto" class="block text-gray-700 font-medium mb-2">Monto</label>
            <input type="number" id="monto" name="monto" step="0.01" min="0" required class="w-full border border-gray-300 rounded px-3 py-2" />
        </div> <!--Campos para ingresar la fecha y el monto del pago.-->

        <button type="submit" class="w-full bg-red-500 text-white font-bold py-3 rounded hover:bg-red-700">Registrar Pago</button>
    </form>
</main>

</body>
</html>

<?php
$conn->close(); //cierre de la conexión a la base de datos para liberar recursos.
?>