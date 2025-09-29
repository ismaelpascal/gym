<?php

$conn = include __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$apellido = $data['apellido'];
$fecha_nacimiento = $data['fecha_nacimiento'];
$domicilio = $data['domicilio'];
$telefono = $data['telefono'];
$dni = $data['dni'];

if ($dni) {
    $sql = "UPDATE usuarios SET nombre=?, apellido=?, fecha_nacimiento=?, domicilio=?, telefono=? WHERE dni=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $fecha_nacimiento, $domicilio, $telefono, $dni);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
?>
