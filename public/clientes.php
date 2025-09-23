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

          <thead class="bg-white">
            <tr>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Nombre</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Apellido</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">DNI</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Celular</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Acciones</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4">Juan</td>
              <td class="px-6 py-4">Pérez</td>
              <td class="px-6 py-4">12345678</td>
              <td class="px-6 py-4">1122334455</td>
              <td class="px-6 py-4 flex items-center gap-2">
              <button class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 text-sm">Editar</button>
              <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 text-sm">Eliminar</button>
              <label class="flex items-center gap-1">
                <input type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <span class="text-sm text-gray-700">Pago</span>
              </label>
            </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
    <script src="js/main.js"></script>
</html>
