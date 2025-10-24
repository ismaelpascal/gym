<?php
$conn = include __DIR__ . '/../config/database.php';

$usuarios = [];

// Obtenemos la información del usuario y si tiene un pago en el mes calendario actual
$sql = "SELECT u.dni, u.nombre, u.apellido, u.fecha_nacimiento, u.domicilio, u.telefono, 
         MAX(CASE WHEN YEAR(p.fecha_pago) = YEAR(CURDATE()) AND MONTH(p.fecha_pago) = MONTH(CURDATE()) THEN 1 ELSE 0 END) AS pago_mes_actual
     FROM usuarios u
     LEFT JOIN pagos p ON p.dni = u.dni
     GROUP BY u.dni, u.nombre, u.apellido, u.fecha_nacimiento, u.domicilio, u.telefono";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Aseguramos tipos correctos para JSON
        $row['pago_mes_actual'] = (int)$row['pago_mes_actual'];
        $usuarios[] = $row;
    }
    $result->free();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($usuarios);

/*CODIGO VIEJO (por si las dudas)

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
echo json_encode($usuarios);*/
?>
