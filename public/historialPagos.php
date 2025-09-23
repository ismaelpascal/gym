<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-100/20 font-sans flex h-screen">

<?php include '../src/components/sideBar.php'; ?>

<main class="flex-grow">
    <div class="p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Historial de Pagos</h1>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- El ID de la tabla es "clientesTable" -->
            <table id="clientesTable" class="w-full">

                <?php include '../src/components/buscar.php'; ?>

                <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Nombre</th>
                    <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Apellido</th>
                    <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Estado del Mes Actual</th>
                    <th class="px-6 py-4 text-left text-xs text-black uppercase font-bold tracking-wider">Historial</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <!-- Los datos se insertarán aquí -->
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let clientes = [];
    fetch('data/datosEjHistorial.json?nocache=' + new Date().getTime())
        .then(response => response.json())
        .then(data => {
            clientes = data.usuarios;
            mostrarHistorialPagos(clientes);
        })
        .catch(error => console.error("Error al cargar el JSON:", error));

    function mostrarHistorialPagos(lista) {
        const tbody = document.querySelector("#clientesTable tbody");
        tbody.innerHTML = '';

        const hoy = new Date();
        const anioActual = hoy.getFullYear();
        const mesActual = hoy.getMonth() + 1;

        lista.forEach(cliente => {
            const pagoDelMes = cliente.pagos.find(pago => {
                const fechaPago = new Date(pago.fecha + "T00:00:00");
                return fechaPago.getFullYear() === anioActual && (fechaPago.getMonth() + 1) === mesActual;
            });

            const row = document.createElement("tr");
            row.className = "hover:bg-gray-50 transition-colors duration-200";

            const estadoMesHtml = pagoDelMes ?
                `<span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">${pagoDelMes.fecha}</span>` :
                `<span class="text-sm font-medium text-red-600">No pagó este mes</span>`;

            const historialOptions = cliente.pagos
                .map(pago => `<option value="${pago.fecha}">${formatearFecha(pago.fecha)}</option>`)
                .join('');

            const historialSelectHtml = `
                <select class="block w-full bg-gray-50 border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm">
                    <option value="">Seleccionar mes</option>
                    ${historialOptions}
                </select>
            `;
            
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${cliente.nombre}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${cliente.apellido}</td>
                <td class="px-6 py-4 whitespace-nowrap">${estadoMesHtml}</td>
                <td class="px-6 py-4 whitespace-nowrap">${historialSelectHtml}</td>
            `;

            tbody.appendChild(row);
        });
    }

    function formatearFecha(fechaString) {
        const fecha = new Date(fechaString + "T00:00:00");
        const opciones = { year: 'numeric', month: 'long' };
        return new Intl.DateTimeFormat('es-ES', opciones).format(fecha);
    }
});
</script>

</body>
</html>

