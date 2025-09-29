CREATE TABLE `usuarios` (
  `dni` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL PRIMARY KEY,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `domicilio` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `dni` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  `metodo_pago` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `dni_idx` (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `administradores` (
  `id_admin` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario` VARCHAR(50) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `usuarios` (`dni`, `nombre`, `apellido`, `fecha_nacimiento`, `domicilio`, `telefono`) VALUES
('28123456', 'Carlos', 'Gómez', '1980-05-15', 'Calle Falsa 123', '3446123456'),
('35789012', 'Lucía', 'Martínez', '1992-11-20', 'Avenida Siempreviva 742', '3446987654'),
('45386724', 'Sebastian Ismael', 'Paiva Molina', '2003-11-10', 'Bolivar 1535', '03446607318');

INSERT INTO `pagos` (`id_pago`, `dni`, `monto`, `fecha_pago`, `metodo_pago`) VALUES
(1, '28123456', 5000.00, '2025-09-05', 'Efectivo'),
(2, '35789012', 5000.00, '2025-08-10', 'Transferencia'),
(3, '28123456', 5000.00, '2025-08-05', 'Efectivo');
