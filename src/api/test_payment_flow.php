<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = include __DIR__ . '/../config/database.php';

function fetch_clientes($conn) {
    $clientes = [];
    $sql = "SELECT u.dni, u.nombre, u.apellido, u.fecha_nacimiento, u.domicilio, u.telefono, 
               MAX(CASE WHEN YEAR(p.fecha_pago) = YEAR(CURDATE()) AND MONTH(p.fecha_pago) = MONTH(CURDATE()) THEN 1 ELSE 0 END) AS pago_mes_actual
        FROM usuarios u
        LEFT JOIN pagos p ON p.dni = u.dni
        GROUP BY u.dni, u.nombre, u.apellido, u.fecha_nacimiento, u.domicilio, u.telefono";

    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row['pago_mes_actual'] = (int)$row['pago_mes_actual'];
            $clientes[] = $row;
        }
        $result->free();
    }
    return $clientes;
}

// Obtener lista inicial
$antes = fetch_clientes($conn);

// Determinar DNI de prueba: ?dni=XXXXXXXX o primer usuario
$test_dni = isset($_GET['dni']) ? $_GET['dni'] : (count($antes) ? $antes[0]['dni'] : null);
if (!$test_dni) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'No hay usuarios en la base de datos y no se proporciona DNI.']);
    exit;
}

// Insertar pago de prueba
$monto = 5000.00;
$metodo = 'Prueba';
$fecha_pago = date('Y-m-d');

$insert_sql = "INSERT INTO pagos (dni, monto, fecha_pago, metodo_pago) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($insert_sql);
if (!$stmt) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Error preparando la inserción: ' . $conn->error]);
    exit;
}
$stmt->bind_param('sdss', $test_dni, $monto, $fecha_pago, $metodo);
$ok = $stmt->execute();
$stmt->close();

$despues = fetch_clientes($conn);
$conn->close();

header('Content-Type: application/json');
echo json_encode([
    'status' => $ok ? 'success' : 'error',
    'dni_test' => $test_dni,
    'antes' => $antes,
    'despues' => $despues,
    'message' => $ok ? 'Pago de prueba insertado.' : 'Fallo al insertar pago de prueba.'
], JSON_PRETTY_PRINT);
