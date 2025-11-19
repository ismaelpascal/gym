<?php
/*$host = "sql200.infinityfree.com";
$usuario = "if0_40451663";
$password = "edicionHabibi31";
$base_de_datos = "if0_40451663_gym";*/ //BD de infinityFree

$host = "localhost"; 
$usuario = "root"; 
$password = ""; 
$base_de_datos = "gym"; 

$conn = new mysqli($host, $usuario, $password, $base_de_datos);
$conn->set_charset("utf8mb4");

return $conn;
?>
