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
        <h1 class="text-3xl font-bold text-gray-800">Lista de Clientes Habibi</h1>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table id="clientesTable" class="w-full">
        
  
<?php include '../src/components/header.php'; ?>

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
</html>