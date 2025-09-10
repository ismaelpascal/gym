<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Listado de Clientes</title>
</head>
<body class="bg-amber-100/20 font-sans flex h-screen">
  <?php
    require_once __DIR__ . '/templates/sidebar.php'; 
  ?>

  <main class="flex-grow">
    <div class="p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Lista de Clientes Habibi</h1>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table id="clientesTable" class="w-full">
        
        <div class="p-8">
          <form method="POST" action="bd.php">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                    <input type="text" id="apellido" name="apellido" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">DNI</label>
                    <input type="number" id="dni" name="dni" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label for="fechaNac" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                    <input type="date" id="fechaNac" name="fechaNac" required class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-500">
                </div>
            </div>

            <div>
                <label for="domicilio" class="block text-sm font-medium text-gray-700 mb-1">Domicilio</label>
                <input type="text" id="domicilio" name="domicilio" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-red-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-red-700">Guardar</button>
            </div>
          </form>
        </div>

        <div class="mb-4">
        <input 
          type="text" 
          id="search" 
          placeholder="Buscar cliente por cualquier dato..."
          class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

          <thead class="bg-white">
            <tr>
              <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Nombre</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Apellido</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">DNI</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Celular</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
  <script src="js/main.js"></script>
</html>