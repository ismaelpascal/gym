let clientes = [];
fetch('data/usuarios.json?nocache=' + new Date().getTime())
  .then(response => response.json())
  .then(data => {
    clientes = data.usuarios;
    mostrarClientes(clientes);
  })
  .catch(error => console.error("Error al cargar el JSON:", error));

function mostrarClientes(lista) {
  const tbody = document.querySelector("#clientesTable tbody");
  tbody.innerHTML = '';

  lista.forEach((cliente, index) => {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td class="px-6 py-4 text-sm text-gray-700">${cliente.nombre}</td>
        <td class="px-6 py-4 text-sm text-gray-700">${cliente.apellido}</td>
        <td class="px-6 py-4 text-sm text-gray-700">${cliente.dni}</td>
        <td class="px-6 py-4 text-sm text-gray-700">${cliente.telefono}</td>
        <td class="px-6 py-4">
          <div class="space-x-2">
            <button class="bg-yellow-400 hover:bg-yellow-700 text-white text-xs py-1 px-3 rounded-md duration-300" onclick="editarCliente(${index})">Editar</button>
            <button class="bg-red-500 hover:bg-red-700 text-white text-xs py-1 px-3 rounded-md duration-300" onclick="eliminarCliente(${index})">Eliminar</button>
            <button class="bg-green-500 hover:bg-green-700 text-white text-xs py-1 px-3 rounded-md duration-300" onclick="verPagos(${index})">Ver Pagos</button>
          </div>
        </td>
      `;
    tbody.appendChild(row);
  });
}

function guardarCambios() {
  fetch('../src/components/guardarUsuario.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(clientes)
  })
    .then(response => response.json())
    .then(data => {
      console.log("Guardado:", data);
      alert("Cambios guardados ✅");
    })
    .catch(error => console.error("Error al guardar:", error));
}

function editarCliente(index) {
  const cliente = clientes[index];
  const nuevoNombre = prompt("Editar nombre:", cliente.nombre);
  const nuevoApellido = prompt("Editar apellido:", cliente.apellido);
  const nuevoDni = prompt("Editar DNI:", cliente.dni);
  const nuevoTelefono = prompt("Editar teléfono:", cliente.telefono);

  if (nuevoNombre && nuevoApellido && nuevoDni && nuevoTelefono) {
    clientes[index] = {
      nombre: nuevoNombre,
      apellido: nuevoApellido,
      dni: nuevoDni,
      telefono: nuevoTelefono
    };
    mostrarClientes(clientes);
    guardarCambios();
  }
}

function eliminarCliente(index) {
  if (confirm("¿Seguro que deseas eliminar este cliente?")) {
    clientes.splice(index, 1);
    mostrarClientes(clientes);
    guardarCambios();
  }
}

function verPagos(index) {
  alert("Pagos de: " + clientes[index].nombre);
}
