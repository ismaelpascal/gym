<?php

$conn = include __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents('php://input'), true);
$dni = $data['dni'];

if ($dni) {
    $sql = "DELETE FROM usuarios WHERE dni = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
?>
