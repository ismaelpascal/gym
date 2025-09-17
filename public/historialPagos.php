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

<main class="flex-grow">
    <div class="p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Historial de Pagos</h1>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table id="clientesTable" class="w-full">

<?php include '../src/components/buscar.php'; ?>

          <thead class="bg-white">
            <tr>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Nombre</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Apellido</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Pagado S/N</th>
              <th class="px-6 py-4 text-left text-xs text-black uppercase">Historial</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
<script>
const data = [
  {
    nombre: "Carlos",
    apellido: "Gómez",
    fecha_pago: "2025-04-05",
    historial_pagos: ["2025-03-03", "2025-02-01", "2025-01-05", "2024-12-04", "2024-11-02"]
  },
  {
    nombre: "Lucía",
    apellido: "Martínez",
    fecha_pago: null,
    historial_pagos: ["2025-03-10", "2025-02-08", "2025-01-12"]
  },
  {
    nombre: "Javier",
    apellido: "López",
    fecha_pago: "2025-04-10",
    historial_pagos: []
  },
  {
    nombre: "Ana",
    apellido: "Fernández",
    fecha_pago: null,
    historial_pagos: ["2025-03-07", "2025-02-05", "2025-01-09", "2024-12-06", "2024-11-04", "2024-10-02", "2024-09-01"]
  },
  {
    nombre: "Miguel",
    apellido: "Ruiz",
    fecha_pago: "2025-04-08",
    historial_pagos: ["2025-03-06"]
  },
  {
    nombre: "Sofía",
    apellido: "Díaz",
    fecha_pago: null,
    historial_pagos: []
  },
  {
    nombre: "Pedro",
    apellido: "Sánchez",
    fecha_pago: "2025-04-02",
    historial_pagos: ["2025-03-01", "2025-02-03", "2025-01-07", "2024-12-05"]
  },
  {
    nombre: "Laura",
    apellido: "Torres",
    fecha_pago: null,
    historial_pagos: ["2025-03-12", "2025-02-10"]
  },
  {
    nombre: "Diego",
    apellido: "Ramírez",
    fecha_pago: "2025-04-09",
    historial_pagos: ["2025-03-08", "2025-02-06", "2025-01-04", "2024-12-03", "2024-11-07", "2024-10-05"]
  },
  {
    nombre: "Elena",
    apellido: "Moreno",
    fecha_pago: null,
    historial_pagos: ["2025-03-15"]
  }
];

// Meses del año
const MESES = [
  { num: 1, nombre: "Enero" },
  { num: 2, nombre: "Febrero" },
  { num: 3, nombre: "Marzo" },
  { num: 4, nombre: "Abril" },
  { num: 5, nombre: "Mayo" },
  { num: 6, nombre: "Junio" },
  { num: 7, nombre: "Julio" },
  { num: 8, nombre: "Agosto" },
  { num: 9, nombre: "Septiembre" },
  { num: 10, nombre: "Octubre" },
  { num: 11, nombre: "Noviembre" },
  { num: 12, nombre: "Diciembre" }
];

// Año actual para comparar
const ANIO_ACTUAL = 2025;
const MES_ACTUAL = 4; // Abril

function renderizarClientes() {
  const tbody = document.querySelector("#clientesTable tbody");
  tbody.innerHTML = '';

  data.forEach(cliente => {
    const row = document.createElement("tr");

    // Extraer todos los meses pagados (del historial + pago actual)
    const fechasPagadas = [...cliente.historial_pagos];
    if (cliente.fecha_pago) fechasPagadas.push(cliente.fecha_pago);

    // Convertir a Set de "MM" (meses pagados en formato 2 dígitos)
    const mesesPagados = new Set(
      fechasPagadas
        .filter(fecha => fecha.startsWith(ANIO_ACTUAL.toString()))
        .map(fecha => fecha.split('-')[1]) // Extrae "04", "03", etc.
    );

    // Generar opciones del select con colores
    const opcionesMeses = MESES.map(mes => {
      const mesStr = mes.num.toString().padStart(2, '0'); // "01", "02", ..., "12"
      let clase = "text-gray-400"; // Por defecto: gris (futuro o no aplicable)

      if (mes.num < MES_ACTUAL) {
        // Mes pasado: esperamos que esté pagado
        clase = mesesPagados.has(mesStr) ? "text-green-600 font-semibold" : "text-red-500";
      } else if (mes.num === MES_ACTUAL) {
        // Mes actual
        clase = cliente.fecha_pago ? "text-green-600 font-semibold" : "text-red-500";
      } else {
        // Mes futuro
        clase = "text-gray-400";
      }

      return `<option class="${clase}" value="${mes.num}">${mes.nombre}</option>`;
    }).join('');

    row.innerHTML = `
      <td class="px-6 py-4 text-sm text-gray-700">${cliente.nombre}</td>
      <td class="px-6 py-4 text-sm text-gray-700">${cliente.apellido}</td>
      <td class="px-6 py-4 text-sm text-gray-700">
        ${cliente.fecha_pago || '<span class="text-red-500">No pagó este mes</span>'}
      </td>
      <td class="px-6 py-4">
        <select class="border rounded px-2 py-1 w-full bg-white focus:ring-2 focus:ring-blue-300">
          <option value="" disabled selected>Seleccionar mes</option>
          ${opcionesMeses}
        </select>
      </td>
    `;
    tbody.appendChild(row);
  });
}

// Aplicar estilo dinámico a las opciones del select (¡IMPORTANTE!)
function aplicarEstilosSelects() {
  document.querySelectorAll('#clientesTable select').forEach(select => {
    select.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      this.className = 'border rounded px-2 py-1 w-full bg-white focus:ring-2 focus:ring-blue-300';
      // Opcional: puedes hacer algo al seleccionar un mes
    });
  });
}

// Inicializar cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
  renderizarClientes();
  setTimeout(aplicarEstilosSelects, 100); // Pequeño delay para asegurar renderizado
});
</script>
</html>