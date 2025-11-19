<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = include __DIR__ . '/../config/database.php';

// 1. Obtenemos un diccionario de todos los usuarios
$usuarios = [];
$sql_usuarios = "SELECT dni, nombre, apellido FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);
while ($row = $result_usuarios->fetch_assoc()) {
    $usuarios[$row['dni']] = [
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'pagos' => []
    ];
}

$sql_pagos = "SELECT dni, monto, fecha_pago, metodo_pago FROM pagos ORDER BY fecha_pago DESC";
$result_pagos = $conn->query($sql_pagos);
while ($row = $result_pagos->fetch_assoc()) {
    $dni = $row['dni'];
    if (isset($usuarios[$dni])) {
        $usuarios[$dni]['pagos'][] = [
            'monto' => $row['monto'],
            'fecha' => $row['fecha_pago'],
            'metodo' => $row['metodo_pago']
        ];
    }
}

$conn->close();

$historial_final = array_values($usuarios);

header('Content-Type: application/json');
echo json_encode($historial_final);
?>
