```markdown
# GYM Habibi - Sistema de Gestión

Este es un sistema de gestión de clientes simple para un gimnasio, desarrollado con PHP, MySQL y Tailwind CSS. La aplicación permite registrar nuevos clientes, ver una lista de los clientes existentes y buscar en la misma.

---

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP
- **Frontend**: HTML, Tailwind CSS, JavaScript
- **Base de Datos**: MySQL (para la lógica principal) y archivos JSON (para la carga de datos en el frontend)

---

## 🚀 Cómo Empezar

Sigue estos pasos para configurar el proyecto en tu entorno de desarrollo local.

### ✅ Prerrequisitos

- Un servidor web local (como XAMPP, WAMP, MAMP o el servidor integrado de PHP).
- PHP 8.0 o superior.
- MySQL o MariaDB.

---

### ⚙️ Instalación

```bash
git clone https://github.com/ismaelpascal/gym.git
cd gym
```

---

## 🔄 Flujo de Trabajo Básico con Git

### 1. Sincroniza tu repositorio local

Antes de empezar a programar, asegúrate de tener la última versión del código para evitar conflictos.

```bash
git pull origin main
```

### 2. Añade tus cambios al área de preparación (Staging)

Una vez que hayas modificado los archivos, necesitas prepararlos para guardarlos en el historial.

Para añadir un archivo específico:

```bash
git add ruta/al/archivo_modificado.php
```

Para añadir todos los archivos que has modificado de una sola vez:

```bash
git add .
```

### 3. Guarda tus cambios (Commit)

Crea un "punto de guardado" en el historial del proyecto con un mensaje que describa los cambios que hiciste.

```bash
git commit -m "Aquí va tu comentario descriptivo"
```

### 4. Sube tus cambios al repositorio remoto

Finalmente, envía los cambios que guardaste (tu commit) al repositorio en la nube para que otros puedan verlos.

```bash
git push origin main
```

---

### 🗃️ Configura la Base de Datos

1. Crea una nueva base de datos en tu gestor de MySQL.
2. Importa la estructura de tablas necesaria `src/config/bd.sql`.
3. Actualiza las credenciales de conexión en el archivo `src/config/bd.php`.

---

## 🧭 Convenciones de Código

Para mantener la consistencia en el código, se aplican las siguientes convenciones:

- **camelCase**: Para nombrar archivos (`registrarClientes.php`), variables y funciones JavaScript (`listaClientes`), y atributos HTML/JSON (`fechaNac`).
- **PascalCase**: Se reserva para la declaración de Clases en PHP o JavaScript (`class DatabaseManager`).

---

### 🌐 Configura tu Servidor Web

> **¡Importante!** La raíz de tu servidor web (DocumentRoot) debe apuntar a la carpeta `public/` del proyecto, no a la raíz del repositorio. Esto es crucial por seguridad.

---

## 📁 Estructura de Carpetas

El proyecto sigue una arquitectura limpia y segura. Solo `public/` es accesible desde el navegador.

📦 gym/
├── 📂 public/ → 🌐 Directorio público (raíz del servidor web)
│ ├── 📂 data/
│ │ └── 📄 usuarios.json → 🧩 Datos dinámicos para el frontend
│ ├── 📂 js/
│ │ └── 📄 main.js → 🎛️ Lógica interactiva del cliente
│ ├── 📄 clientes.php → 👥 Página principal de gestión de clientes
│ └── ... → 🖼️ Más páginas públicas (index.php, etc.)
│
├── 📂 src/ → 🔒 Código fuente protegido (NO accesible directamente)
│ ├── 📂 components/
│ │ ├── 📄 buscador.php → 🔍 Componente reutilizable de búsqueda
│ │ └── ... → 🧱 Otros componentes UI (header, sidebar, etc.)
│ │
│ └── 📂 config/
│   └── 📄 bd.php → ⚙️ Configuración de conexión a la base de datos
│
├── 📄 README.md → 📘 Documentación del proyecto
└── 📄 tailwind.config.js → 🎨 Configuración de Tailwind CSS — ¡NO BORRAR!

---

## 🎨 Patrones de Diseño y Arquitectura

- **Arquitectura public/src**: Se utiliza para prevenir el acceso directo a archivos sensibles (como la configuración de la base de datos) desde el navegador. Solo el contenido de la carpeta `public/` es servido al usuario.
- **Enfoque Basado en Componentes**: Las páginas se construyen incluyendo componentes reutilizables (como `sidebar.php` o `buscador.php`) usando la función `include` de PHP. Esto mantiene el código de las páginas principales limpio y fácil de leer.
- **Carga de Datos Asíncrona**: El listado de clientes se carga dinámicamente usando la API `fetch` de JavaScript para leer un archivo `usuarios.json`, lo que permite actualizar la tabla sin necesidad de recargar la página completa.
```