<?php
// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$password = "";
$base_de_datos = "gym";

$conn = new mysqli($host, $usuario, $password, $base_de_datos);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener usuarios y sus pagos
$sql = "
SELECT u.id, u.nombre, u.apellido, hp.fecha_pago
FROM usuarios u
LEFT JOIN historial_pagos hp ON u.id = hp.usuario_id
ORDER BY u.apellido, u.nombre, hp.fecha_pago DESC
";

$result = $conn->query($sql);

$usuarios = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        if (!isset($usuarios[$id])) {
            $usuarios[$id] = [
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido'],
                'pagos' => []
            ];
        }
        if ($row['fecha_pago']) {
            $usuarios[$id]['pagos'][] = $row['fecha_pago'];
        }
    }
}
$conn->close();

// Construir el array final para JS
$data = [];
foreach ($usuarios as $u) {
    $pagos = $u['pagos'];
    rsort($pagos);

    $fecha_pago_actual = count($pagos) ? $pagos[0] : null;
    $historial_pagos = count($pagos) > 1 ? array_slice($pagos, 1) : [];

    $data[] = [
        'nombre' => $u['nombre'],
        'apellido' => $u['apellido'],
        'fecha_pago' => $fecha_pago_actual,
        'historial_pagos' => $historial_pagos
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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

<script>
const data = <?= json_encode($data, JSON_UNESCAPED_UNICODE) ?>;

// Configuración de meses y fecha actual
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

const ANIO_ACTUAL = 2025;
const MES_ACTUAL = 9;

function renderizarClientes() {
  const tbody = document.querySelector("#clientesTable tbody");
  tbody.innerHTML = '';

  data.forEach(cliente => {
    const row = document.createElement("tr");

    const fechasPagadas = [...cliente.historial_pagos];
    if (cliente.fecha_pago) fechasPagadas.push(cliente.fecha_pago);

    const mesesPagados = new Set(
      fechasPagadas
        .filter(fecha => fecha.startsWith(ANIO_ACTUAL.toString()))
        .map(fecha => fecha.split('-')[1])
    );

    const opcionesMeses = MESES.map(mes => {
      const mesStr = mes.num.toString().padStart(2, '0');
      let clase = "text-gray-400";

      if (mes.num < MES_ACTUAL) {
        clase = mesesPagados.has(mesStr) ? "text-green-600 font-semibold" : "text-red-500";
      } else if (mes.num === MES_ACTUAL) {
        clase = cliente.fecha_pago ? "text-green-600 font-semibold" : "text-red-500";
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

function aplicarEstilosSelects() {
  document.querySelectorAll('#clientesTable select').forEach(select => {
    select.addEventListener('change', function() {
      this.className = 'border rounded px-2 py-1 w-full bg-white focus:ring-2 focus:ring-blue-300';
    });
  });
}

document.addEventListener("DOMContentLoaded", () => {
  renderizarClientes();
  setTimeout(aplicarEstilosSelects, 100);
});
</script>

</body>
</html>
