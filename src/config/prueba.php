<!DOCTYPE html>
<html>
<head>
    <title>Registro Usuario</title>
</head>
<body>
    <h1>Registrar nuevo usuario</h1>
    <form action="bd.php" method="POST">
        Nombre: <input type="text" name="nombre"><br>
        Apellido: <input type="text" name="apellido"><br>
        DNI: <input type="text" name="dni"><br>
        Fecha de nacimiento: <input type="date" name="fechaNac"><br>
        Teléfono: <input type="text" name="telefono"><br>
        Domicilio: <input type="text" name="domicilio"><br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
