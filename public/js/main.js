let todosLosClientes = [];

document.addEventListener("DOMContentLoaded", () => {
  cargarClientes();
  
  const inputBusqueda = document.getElementById("search");
  inputBusqueda.addEventListener("input", filtrarClientes);

  const editForm = document.getElementById("editForm");
  editForm.addEventListener("submit", guardarCambiosCliente);
});


function cargarClientes() {
  fetch('../src/api/getClientes.php?nocache=' + new Date().getTime())
    .then(response => response.json())
    .then(data => {
      todosLosClientes = data;
      mostrarClientes(todosLosClientes);
    });
}

function mostrarClientes(lista) {
  const tbody = document.querySelector("#clientesTable tbody");
  tbody.innerHTML = '';

  if (lista.length === 0) {
    tbody.innerHTML = '<tr><td colspan="5" class="text-center p-4 text-gray-500">No se encontraron clientes.</td></tr>';
    return;
  }

  lista.forEach(cliente => {
    const row = document.createElement("tr");
    row.className = "hover:bg-gray-50 transition-colors duration-150";
    
    const pagoRealizado = cliente.pago_mes_actual;
    const checkboxHtml = `
      <label class="flex items-center gap-1 ${pagoRealizado ? 'cursor-not-allowed' : 'cursor-pointer'}">
          <input 
            type="checkbox" 
            class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
            ${pagoRealizado ? 'checked disabled' : ''}
            onchange="registrarPago('${cliente.dni}', this)">
          <span class="text-sm ${pagoRealizado ? 'text-green-700 font-semibold' : 'text-gray-700'}">
            ${pagoRealizado ? 'Pagado' : 'Pagar'}
          </span>
      </label>
    `;

    row.innerHTML = `
        <td class="px-6 py-4 text-sm text-gray-800 font-medium">${cliente.nombre}</td>
        <td class="px-6 py-4 text-sm text-gray-600">${cliente.apellido}</td>
        <td class="px-6 py-4 text-sm text-gray-600">${cliente.dni}</td>
        <td class="px-6 py-4 text-sm text-gray-600">${cliente.telefono || 'No especificado'}</td>
        <td class="px-6 py-4">
          <div class="flex items-center space-x-2">
            <button class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-bold py-1 px-3 rounded-md duration-300" onclick="editarCliente('${cliente.dni}')">Editar</button>
            <button class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1 px-3 rounded-md duration-300" onclick="eliminarCliente('${cliente.dni}')">Eliminar</button>
            ${checkboxHtml}
          </div>
        </td>
      `;
    tbody.appendChild(row);
  });
}

function filtrarClientes() {
  const texto = document.getElementById("search").value.toLowerCase();
  const clientesFiltrados = todosLosClientes.filter(cliente =>
    cliente.nombre.toLowerCase().includes(texto) ||
    cliente.apellido.toLowerCase().includes(texto) ||
    cliente.dni.toLowerCase().includes(texto) ||
    (cliente.telefono && cliente.telefono.toLowerCase().includes(texto))
  );
  mostrarClientes(clientesFiltrados);
}


function editarCliente(dni) {
  fetch(`../src/api/getCliente.php?dni=${dni}`)
    .then(response => response.json())
    .then(cliente => {
      if (!cliente) return;
      document.getElementById('editDniOriginal').value = cliente.dni;
      document.getElementById('editNombre').value = cliente.nombre;
      document.getElementById('editApellido').value = cliente.apellido;
      document.getElementById('editDomicilio').value = cliente.domicilio;
      document.getElementById('editTelefono').value = cliente.telefono;
      document.getElementById('editFechaNac').value = cliente.fecha_nacimiento;
      document.getElementById('editModal').classList.remove('hidden');
    });
}

function cerrarModal() {
  document.getElementById('editModal').classList.add('hidden');
}

function guardarCambiosCliente(event) {
  event.preventDefault();
  const datosActualizados = {
    dni: document.getElementById('editDniOriginal').value,
    nombre: document.getElementById('editNombre').value,
    apellido: document.getElementById('editApellido').value,
    domicilio: document.getElementById('editDomicilio').value,
    telefono: document.getElementById('editTelefono').value,
    fecha_nacimiento: document.getElementById('editFechaNac').value
  };
  fetch('../src/api/actualizarCliente.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(datosActualizados)
  })
  .then(() => {
    cerrarModal();
    cargarClientes();
  });
}

function eliminarCliente(dni) {
  if (confirm(`¿Estás seguro de que quieres eliminar al cliente con DNI ${dni}?`)) {
    fetch('../src/api/eliminarCliente.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ dni: dni })
    })
    .then(() => {
        cargarClientes();
    });
  }
}

function registrarPago(dni, checkboxElement) {
  if (confirm(`¿Confirmas el pago para el cliente con DNI ${dni} para el mes actual?`)) {
    fetch('../src/api/registrarPago.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ dni: dni })
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        checkboxElement.checked = true;
        checkboxElement.disabled = true;
        const label = checkboxElement.nextElementSibling;
        label.textContent = 'Pagado';
        label.classList.add('text-green-700', 'font-semibold');
        label.parentElement.classList.add('cursor-not-allowed');
      }
    });
  } else {
    checkboxElement.checked = false;
  }
}

