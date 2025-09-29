<?php

$conn = include __DIR__ . '/../config/database.php';

$usuarios = [];
$sql = "SELECT dni, nombre, apellido, fecha_nacimiento, domicilio, telefono FROM usuarios";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    $result->free();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($usuarios);
?>
