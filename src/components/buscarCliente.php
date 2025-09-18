<div class="p-3">
    <input 
        type="text" 
        id="search" 
        placeholder="Buscar cliente por cualquier dato..."
        class="w-full p-3 rounded-lg border border-gray-300">
</div>
<script>
  let clientesBuscar = [];

  fetch('data/usuarios.json')
    .then(response => {
      if (!response.ok) {
        throw new Error("No se pudo cargar el JSON");
      }
      return response.json();
    })
    .then(data => {
      clientesBuscar = data;
      mostrarClientes(clientesBuscar);
    })
    .catch(error => {
      console.error("Error al cargar o procesar el JSON:", error);
    });

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

  document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("search");
    input.addEventListener("input", () => {
      const texto = input.value.toLowerCase();
      const filtrados = clientesBuscar.filter(cliente =>
        cliente.nombre.toLowerCase().includes(texto) ||
        cliente.apellido.toLowerCase().includes(texto) ||
        cliente.dni.toLowerCase().includes(texto) ||
        cliente.telefono.toLowerCase().includes(texto)
      );
      mostrarClientes(filtrados);
    });
  });
</script>
