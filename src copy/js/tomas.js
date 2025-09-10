  let data = JSON.parse(localStorage.getItem("clientes")) || [];

  const tbody = document.querySelector("#clientesTable tbody");
  const form = document.getElementById("clienteForm");
  const searchInput = document.getElementById("search");

  function guardarEnLocalStorage() {
    localStorage.setItem("clientes", JSON.stringify(data));
  }

  function renderTable(lista) {
    tbody.innerHTML = "";
    if (lista.length === 0) {
      tbody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-gray-500">No se encontraron resultados</td></tr>`;
      return;
    }
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
          </div>
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const nuevoCliente = {
      nombre: formData.get("nombre"),
      apellido: formData.get("apellido"),
      dni: formData.get("dni"),
      telefono: formData.get("telefono"),
      domicilio: formData.get("domicilio"),
      fechaNac: formData.get("fechaNac"),
    };

    data.push(nuevoCliente);
    guardarEnLocalStorage();
    renderTable(data);
    form.reset();
  });

  function eliminarCliente(index) {
    data.splice(index, 1);
    guardarEnLocalStorage();
    renderTable(data);
  }

  function editarCliente(index) {
    const cliente = data[index];
    const nuevoNombre = prompt("Nuevo nombre:", cliente.nombre);
    if (nuevoNombre !== null) cliente.nombre = nuevoNombre;

    const nuevoApellido = prompt("Nuevo apellido:", cliente.apellido);
    if (nuevoApellido !== null) cliente.apellido = nuevoApellido;

    guardarEnLocalStorage();
    renderTable(data);
  }

  searchInput.addEventListener("input", function () {
    const query = this.value.toLowerCase();
    const filtrados = data.filter(u =>
      u.nombre.toLowerCase().includes(query) ||
      u.apellido.toLowerCase().includes(query) ||
      u.dni.toLowerCase().includes(query) ||
      u.telefono.toLowerCase().includes(query) ||
      u.domicilio.toLowerCase().includes(query) ||
      u.fechaNac.toLowerCase().includes(query)
    );
    renderTable(filtrados);
  });

  renderTable(data);