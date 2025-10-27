<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Historial de Pagos</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="icono.png" type="image/png">
</head>
<body class="bg-gray-50 font-sans flex h-screen">

<?php include '../src/components/sideBar.php'; ?>

<main class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-gray-800 uppercase">
        <span class="text-4xl">H</span>ISTORIAL DE <span class="text-4xl">P</span>AGOS
    </h1>

    <div class="bg-white rounded-xl shadow-[0_8px_25px_rgba(0,0,0,0.18)] overflow-hidden mt-6 border border-gray-100 font-sans text-gray-800 hover:shadow-[0_10px_35px_rgba(0,0,0,0.25)] transition-all duration-300 w-full max-w-6xl mx-auto">
    <div class="p-6">
            <input 
                type="text" 
                id="searchHistorial" 
                placeholder="Buscar cliente por nombre o apellido..."
                class="w-full p-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-700 focus:outline-none">
        </div>
        
        <table id="historialTable" class="w-full">
            <thead class="bg-rose-500 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-xs text-white uppercase font-bold tracking-wider">Nombre</th>
                <th class="px-6 py-4 text-left text-xs text-white uppercase font-bold tracking-wider">Apellido</th>
                <th class="px-6 py-4 text-left text-xs text-white uppercase font-bold tracking-wider">Estado del Mes Actual</th>
                <th class="px-6 py-4 text-left text-xs text-white uppercase font-bold tracking-wider">Historial de Pagos</th>
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
