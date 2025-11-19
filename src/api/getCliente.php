<?php
$conn = include __DIR__ . '/../config/database.php';

$dni = isset($_GET['dni']) ? $conn->real_escape_string($_GET['dni']) : null;

if (!$dni) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['status' => 'error', 'message' => 'Falta el parámetro dni']);
    exit;
}

$sql = "SELECT u.dni, u.nombre, u.apellido, u.fecha_nacimiento, u.domicilio, u.telefono,
               (SELECT COUNT(*) > 0 FROM pagos p WHERE p.dni = u.dni AND MONTH(p.fecha_pago) = MONTH(CURDATE()) AND YEAR(p.fecha_pago) = YEAR(CURDATE())) AS pago_mes_actual
        FROM usuarios u
        WHERE u.dni = '" . $dni . "' LIMIT 1";

$result = $conn->query($sql);
if (!$result) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['status' => 'error', 'message' => 'Error en la consulta: ' . $conn->error]);
    $conn->close();
    exit;
}

$cliente = $result->fetch_assoc();
if ($cliente) {
    $cliente['pago_mes_actual'] = (bool)$cliente['pago_mes_actual'];
} else {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(null);
    $result->free();
    $conn->close();
    exit;
}

$result->free();
$conn->close();

header('Content-Type: application/json');
echo json_encode($cliente);
?>
