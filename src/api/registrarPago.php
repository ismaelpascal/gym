<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = include __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['dni'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['status' => 'error', 'message' => 'No se proporcionó el DNI del cliente.']);
    exit;
}

$dni = $data['dni'];
$monto = 5000.00;
$metodo_pago = 'Efectivo';
$fecha_pago = date('Y-m-d');

$sql = "INSERT INTO pagos (dni, monto, fecha_pago, metodo_pago) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("sdss", $dni, $monto, $fecha_pago, $metodo_pago);

if ($stmt->execute()) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Pago registrado correctamente.']);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['status' => 'error', 'message' => 'Error de la base de datos: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>

