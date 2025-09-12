<?php
session_start();
if (!isset($_SESSION['autenticado'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sistema</title>
</head>
<body>
  <h2>Bienvenido el sistem Habibi</h2>
  <p>Tu acceso fue validado correctamente.</p>
</body>
</html>

