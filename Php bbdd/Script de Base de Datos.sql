--
-- Base de datos: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE `usuarios` (
  `id` INT(8) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(32) NOT NULL,
  `clave` VARCHAR(64) NOT NULL COMMENT 'Se espera un hash MD5, como se indica en la actividad 2',
  `tipo` INT(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estructura de tabla para la tabla `libros`
--
CREATE TABLE `libros` (
  `id` INT(8) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(128) NOT NULL,
  `autor` VARCHAR(64) NOT NULL,
  `isbn` VARCHAR(13) NOT NULL,
  `puntuacion` INT(8) NOT NULL,
  `genero` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos de ejemplo (opcional, para pruebas)
--

-- Insertar un usuario de prueba: nombre = "admin", clave = "admin" (MD5: 21232f297a57a5a743894a0e4a801fc3)
INSERT INTO `usuarios` (`nombre`, `clave`, `tipo`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- Insertar libros de ejemplo (basados en la imagen)
INSERT INTO `libros` (`nombre`, `autor`, `isbn`, `puntuacion`, `genero`) VALUES
('Biografía a dos voces', 'Ignacio Ramonet', '978848065570', 5, 'Biografia'),
('Lo que decimos, se hace...', 'Noam Chomsky', '978848307831', 5, 'Assaig'),
('Ebano', 'Ryszard Kapuscinski', '1452345125781', 5, 'Assaig'),
('Norwegian Wood', 'Haruki Murakami', '3847123068243', 4, 'Novel.la'),
('La fiesta del chivo', 'Mario Vargas Llosa', '4213456278612', 2, 'Novel.la');