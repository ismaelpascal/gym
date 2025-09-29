<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Clientes</title>
</head>
<body class="bg-amber-100/20 font-sans flex h-screen">
  
<?php include '../src/components/sideBar.php'; ?>

  <main class="flex-grow">
    <div class="p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Lista de Clientes</h1>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table id="clientesTable" class="w-full">
          <?php include '../src/components/buscarCliente.php'; ?>
          <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Apellido</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">DNI</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Celular</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center hidden">
    <div class="relative mx-auto p-8 border w-full max-w-lg shadow-lg rounded-md bg-white">
      <h3 class="text-2xl font-bold mb-6 text-gray-800">Editar Cliente</h3>
      <form id="editForm">
        <input type="hidden" id="editDniOriginal" name="dni">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label for="editNombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" id="editNombre" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500">
          </div>
          <div>
            <label for="editApellido" class="block text-sm font-medium text-gray-700">Apellido</label>
            <input type="text" id="editApellido" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500">
          </div>
        </div>
        <div class="mb-4">
          <label for="editDomicilio" class="block text-sm font-medium text-gray-700">Domicilio</label>
          <input type="text" id="editDomicilio" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label for="editTelefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="tel" id="editTelefono" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500">
          </div>
          <div>
            <label for="editFechaNac" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
            <input type="date" id="editFechaNac" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500">
          </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
          <button type="button" onclick="cerrarModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancelar</button>
          <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>

  <script src="js/main.js"></script>
</body>
</html>

