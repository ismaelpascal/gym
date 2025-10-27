<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="icono.png" type="image/png">
</head>
<body class="bg-amber-100/20">
  <main class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full p-10 bg-white rounded-2xl shadow-xl border border-gray-200">

      <div class="flex justify-center mb-4">
        <img src="/gym/public/logo.png" alt="Logo Empresa" class="h-24 w-auto">
      </div>

      <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">Iniciar Sesión</h2>

      <form class="space-y-4" action="clientes.php" method="GET">
        <div>
          <input 
            id="user" 
            name="user" 
            type="text" 
            required
            placeholder="Usuario"
            class="block w-full px-4 py-2.5 border border-gray-300 placeholder-gray-400 text-black rounded-lg sm:text-sm">
        </div>

        <div>
          <input 
            id="password" 
            name="password" 
            type="password" 
            required
            placeholder="Contraseña"
            class="block w-full px-4 py-2.5 border border-gray-300 placeholder-gray-400 text-black rounded-lg sm:text-sm">
        </div>

        <div>
          <button 
            type="submit"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white bg-rose-500 shadow hover:bg-rose-600 transition">Ingresar</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
