<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Listado de Clientes</title>
</head>
<body class="bg-amber-100/20 font-sans">
  <div class="max-w-6xl mx-auto p-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Lista de Clientes Habibi</h1>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
      <form id="clienteForm">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required><br><br>

        <label for="dni">DNI:</label>
        <input type="number" name="dni" required><br><br>

        <label for="fechaNac">Fecha de nacimiento:</label>
        <input type="date" name="fechaNac" required><br><br>

        <label for="domicilio">Domicilio:</label>
        <input type="text" name="domicilio" required><br><br>

        <label for="telefono">Telefono:</label>
        <input type="tel" name="telefono" required><br><br>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Guardar</button>
      </form>
    </div>

    <div class="mb-4">
      <input 
        type="text" 
        id="search" 
        placeholder="Buscar cliente por cualquier dato..."
        class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
      >
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <table id="clientesTable" class="w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Apellido</th>
            <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">DNI</th>
            <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Celular</th>
            <th class="px-6 py-4 text-left text-xs text-black uppercase tracking-wider">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200"></tbody>
      </table>
    </div>
  </div>

  <script src="js/main.js"></script>
</body>
</html>
