const data = [
  { nombre: "Juan", apellido: "Pérez", email: "juanperez@mail.com", dni: "12345678", celular: "123456789" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },


  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
  { nombre: "María", apellido: "López", email: "maria.lopez@mail.com", dni: "87654321", celular: "987654321" },
];

const tbody = document.querySelector("#clientesTable tbody");

data.forEach((cliente, index) => {
  const row = document.createElement("tr");
  row.innerHTML = `
    <td class="px-6 py-4 text-sm text-gray-700">${cliente.nombre}</td>
    <td class="px-6 py-4 text-sm text-gray-700">${cliente.apellido}</td>
    <td class="px-6 py-4 text-sm text-gray-700">${cliente.dni}</td>
    <td class="px-6 py-4 text-sm text-gray-700">${cliente.celular}</td>
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