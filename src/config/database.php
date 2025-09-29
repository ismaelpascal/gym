<?php

$host = "localhost";
$usuario = "root";
$password = "";
$base_de_datos = "gym";

$conn = new mysqli($host, $usuario, $password, $base_de_datos);
$conn->set_charset("utf8mb4");

return $conn;
?>
