<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Historial de Pagos</title>
</head>
<body class="bg-amber-100/20 font-sans flex h-screen">

<?php include '../src/components/sideBar.php'; ?>

<main class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Historial de Pagos</h1>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-4">
            <input 
                type="text" 
                id="searchHistorial" 
                placeholder="Buscar cliente por nombre o apellido..."
                class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
        </div>
        
        <table id="historialTable" class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Nombre</th>
                <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Apellido</th>
                <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Estado del Mes Actual</th>
                <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Historial de Pagos</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            </tbody>
        </table>
    </div>
</main>

<script src="js/historial.js"></script>

</body>
</html>
