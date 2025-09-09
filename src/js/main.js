fetch('usuarios.json')
  .then(response => {
    if (!response.ok) {
      throw new Error("No se pudo cargar el JSON");
    }
    return response.json();
  })
  .then(data => {
    console.log(data);

    const tbody = document.querySelector("#clientesTable tbody");
    tbody.innerHTML = '';

    data.forEach((cliente, index) => {
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

  })
  .catch(error => {
    console.error("Error al cargar o procesar el JSON:", error);
  });
