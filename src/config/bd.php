<?php

$conn = include __DIR__ . '/database.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fechaNac'];
$telefono = $_POST['telefono'];
$domicilio = $_POST['domicilio'];

$sql_check = "SELECT dni FROM usuarios WHERE dni = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $dni);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    $sql = "UPDATE usuarios SET nombre=?, apellido=?, fecha_nacimiento=?, domicilio=?, telefono=? WHERE dni=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $fecha_nacimiento, $domicilio, $telefono, $dni);
} else {
    $sql = "INSERT INTO usuarios (nombre, apellido, dni, fecha_nacimiento, domicilio, telefono) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $dni, $fecha_nacimiento, $domicilio, $telefono);
}

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: ../../public/clientes.php");
exit;

?>
