<?php
session_start();
session_unset(); 

$hash_predefinido = '$2y$10$/e8izm9PX3PaA7rFE1iCX.bf85AT/Fm4c6ARYMtXMVlqtPsseO0Jq';// Acá iría una contraseña generada con password_hash
$password = $_POST['password'];

if (!isset($password)) {
  http_response_code(400);
  die('Sin contraseña');
}

if (!password_verify($password, $hash_predefinido)) {
  http_response_code(400);
  die('Contraseña incorrecta');
} else {
  $_SESSION['logged_in'] = true;
  header('Location: clientes.php');
  exit;
}
?>