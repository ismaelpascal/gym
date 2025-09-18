CREATE TABLE usuarios (
    dni VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    domicilio VARCHAR(200),
    telefono VARCHAR(20)
);

CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(20) NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    fecha_pago DATE NOT NULL,
    metodo_pago VARCHAR(50),
    FOREIGN KEY (dni) REFERENCES usuarios(dni)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE usuarios_inactivos (
    dni VARCHAR(20) PRIMARY KEY,
    fecha_ultimo_pago DATE,
    fecha_inactivacion DATE NOT NULL,
    FOREIGN KEY (dni) REFERENCES usuarios(dni)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Ejemplo de como agregar que un usuario pagó.
INSERT INTO pagos (id_pago, dni, monto, fecha_pago, metodo_pago)
VALUES ('7', '4321', '4500.00', '2025-09-11', 'transferencia');
