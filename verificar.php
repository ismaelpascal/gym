<?php
session_start();

// Usuario único 
$usuario_valido = "admin";//remplazar por el nombre real
$clave_valida = "1234"; //remplazar por la contraseña real

// Captura de datos del formulario
$usuario = $_POST['usuario'] ?? '';
$clave = $_POST['clave'] ?? '';

// Validación
if ($usuario === $usuario_valido && $clave === $clave_valida) {
    $_SESSION['autenticado'] = true;
    header("Location: sistema.php");
    exit;
} else {
    echo "Usuario o contraseña incorrectos.";
}
?>
