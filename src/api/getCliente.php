<?php

$conn = include __DIR__ . '/../config/database.php';

$clientes = [];

$sql = "
    SELECT 
        u.dni, u.nombre, u.apellido, u.fecha_nacimiento, u.domicilio, u.telefono,
        (SELECT COUNT(*) > 0 FROM pagos p 
         WHERE p.dni = u.dni 
         AND MONTH(p.fecha_pago) = MONTH(CURDATE()) 
         AND YEAR(p.fecha_pago) = YEAR(CURDATE())) AS pago_mes_actual
    FROM 
        usuarios u
";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $row['pago_mes_actual'] = (bool)$row['pago_mes_actual'];
    $clientes[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($cliente);
?>
