<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Registrar Clientes</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="icono.png" type="image/png">
</head>
<body class="bg-gray-50 font-sans flex h-screen">
  
<?php include '../src/components/sideBar.php'; ?>

  <main class="flex-grow">
    <div class="p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 uppercase">
          <span class="text-4xl">R</span>EGISTRAR <span class="text-4xl">C</span>LIENTES
        </h1>
      </div>

      <div class="bg-white rounded-xl shadow-[0_8px_25px_rgba(0,0,0,0.18)] overflow-hidden p-8 mt-6 border border-gray-100">
          <form method="POST" action="../src/config/bd.php">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                    <input type="text" id="apellido" name="apellido" required class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">DNI</label>
                    <input type="number" id="dni" name="dni" required class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label for="fechaNac" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                    <input type="date" id="fechaNac" name="fechaNac" required class="w-full px-4 py-2 border border-gray-400 rounded-lg text-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="mb-6">
                <label for="domicilio" class="block text-sm font-medium text-gray-700 mb-1">Domicilio</label>
                <input type="text" id="domicilio" name="domicilio" required class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="mb-6">
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" required class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-rose-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-rose-600 transition-colors duration-300">Guardar Cliente</button>
            </div>
          </form>
      </div>
    </div>
  </main>
</body>
</html>
