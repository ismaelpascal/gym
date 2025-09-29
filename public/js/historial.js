let historialCompleto = [];

document.addEventListener("DOMContentLoaded", () => {
    cargarHistorial();

    const inputBusqueda = document.getElementById("searchHistorial");
    inputBusqueda.addEventListener("input", filtrarHistorial);
});

function cargarHistorial() {
    fetch('../src/api/getHistorialPagos.php?nocache=' + new Date().getTime())
        .then(response => response.json())
        .then(data => {
            historialCompleto = data;
            mostrarHistorial(historialCompleto);
        })
        .catch(error => {
            console.error("Error al cargar el historial:", error);
            const tbody = document.querySelector("#historialTable tbody");
            tbody.innerHTML = '<tr><td colspan="4" class="text-center p-4 text-red-500">Error al cargar los datos.</td></tr>';
        });
}

function mostrarHistorial(lista) {
    const tbody = document.querySelector("#historialTable tbody");
    tbody.innerHTML = '';

    if (lista.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center p-4 text-gray-500">No se encontraron registros.</td></tr>';
        return;
    }

    const hoy = new Date();
    const anioActual = hoy.getFullYear();
    const mesActual = hoy.getMonth();

    lista.forEach(cliente => {
        const pagoDelMes = cliente.pagos.find(pago => {
            const fechaPago = new Date(pago.fecha);
            return fechaPago.getFullYear() === anioActual && fechaPago.getMonth() === mesActual;
        });

        const row = document.createElement("tr");
        row.className = "hover:bg-gray-50 transition-colors duration-200";

        const estadoMesHtml = pagoDelMes ?
            `<span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">Pagado (${formatearFechaSimple(pagoDelMes.fecha)})</span>` :
            `<span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">Pendiente</span>`;

        let historialHtml;
        if (cliente.pagos.length > 0) {
            const historialOptions = cliente.pagos
                .map(pago => `<option value="${pago.fecha}">${formatearFechaLarga(pago.fecha)} - $${pago.monto} (${pago.metodo})</option>`)
                .join('');
            historialHtml = `
                <select class="block w-full bg-gray-50 border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded-lg text-sm">
                    <option value="">Ver ${cliente.pagos.length} pago(s)</option>
                    ${historialOptions}
                </select>
            `;
        } else {
            historialHtml = `<span class="text-sm text-gray-500">Sin pagos registrados</span>`;
        }
        
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${cliente.nombre}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${cliente.apellido}</td>
            <td class="px-6 py-4 whitespace-nowrap">${estadoMesHtml}</td>
            <td class="px-6 py-4 whitespace-nowrap">${historialHtml}</td>
        `;

        tbody.appendChild(row);
    });
}

function filtrarHistorial() {
    const texto = document.getElementById("searchHistorial").value.toLowerCase();
    const clientesFiltrados = historialCompleto.filter(cliente =>
        cliente.nombre.toLowerCase().includes(texto) ||
        cliente.apellido.toLowerCase().includes(texto)
    );
    mostrarHistorial(clientesFiltrados);
}

function formatearFechaSimple(fechaString) {
    const fecha = new Date(fechaString + "T00:00:00");
    return fecha.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit' });
}

function formatearFechaLarga(fechaString) {
    const fecha = new Date(fechaString + "T00:00:00");
    const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Intl.DateTimeFormat('es-ES', opciones).format(fecha);
}
