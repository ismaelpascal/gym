<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
</head>
<body class="bg-amber-100/20">
  <main class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6 bg-white p-8 border border-gray-300 rounded-lg">
        <div>
            <h2 class="text-center text-2xl font-bold text-gray-900">
                Iniciar Sesión
            </h2>
        </div>
        <form class="space-y-4" action="clientes.php" method="GET">
            <div>
                <label for="user" class="sr-only">Usuario</label>
                <input id="user" name="user" type="text" required class="block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-black rounded-md sm:text-sm" placeholder="Usuario">
            </div>
            <div>
                <label for="password" class="sr-only">Contraseña</label>
                <input id="password" name="password" type="password" required class="block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-black rounded-md sm:text-sm" placeholder="Contraseña">
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600">
                    Ingresar
                </button>
            </div>
        </form>
    </div>
    </main>
</body>
</html>