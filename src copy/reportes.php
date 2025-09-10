<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Reportes - GYM Habibi</title>
</head>
<body class="bg-amber-100/20 font-sans flex">

  <?php
    // Incluimos el componente de la barra lateral
    require_once __DIR__ . '../templates/sidebar.php'; 
  ?>

  <!-- Contenido principal de la página de reportes -->
  <main class="flex-grow">
    <div class="max-w-6xl mx-auto p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Reportes y Estadísticas</h1>
      </div>

      <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Página en Construcción</h2>
        <p class="text-gray-600">
          Aquí se mostrarán los reportes de pagos, asistencia de clientes, y otras estadísticas importantes para el gimnasio.
        </p>
        <!-- Aquí podrías agregar gráficos, tablas de datos, etc. -->
      </div>
    </div>
  </main>
  
</body>
</html>
