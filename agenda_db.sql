-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 03:30:11
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda_db`
DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_actividad` (IN `param0` INT, IN `param1` VARCHAR(255), IN `param2` DATE, IN `param3` VARCHAR(100), IN `param4` VARCHAR(255), IN `param5` TINYINT(1), IN `param6` TIME, IN `param7` TIME, IN `param8` VARCHAR(50), IN `param9` TIME)   BEGIN
	UPDATE actividades SET titulo = param1, fecha = param2, hora = param9, ubicacion = param3, correo = param4, repetir = param5, repetir_inicio = param6, repetir_final = param7, tipo = param8 WHERE id = param0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_actividad` (IN `id_act` INT)   BEGIN
	DELETE FROM actividades WHERE id = id_act;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_actividades` ()   BEGIN
	SELECT id, titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo FROM actividades;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_actividades_filtro` (IN `filtro` VARCHAR(255), IN `valor` VARCHAR(255))   BEGIN
	IF filtro = 'tipo' THEN
		SELECT id, titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo FROM actividades WHERE tipo = valor;
	ELSEIF filtro = 'dia' THEN
		SELECT id, titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo FROM actividades WHERE DAYOFMONTH(fecha) = valor;
	ELSEIF(filtro = "semana") THEN
		SELECT id, titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo FROM actividades WHERE (WEEK(actividades.fecha, 5) - WEEK(DATE_SUB(actividades.fecha, INTERVAL DAYOFMONTH(actividades.fecha) - 1 DAY), 5) + 1) = valor;
	ELSEIF(filtro = "año") THEN
		SELECT id, titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo FROM actividades WHERE YEAR(fecha) = valor;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_actividad` (IN `id_actividad` INT)   BEGIN
	SELECT id, titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo FROM actividades WHERE id = id_actividad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_actividades` (IN `param1` VARCHAR(255), IN `param2` DATE, IN `param3` VARCHAR(100), IN `param4` VARCHAR(255), IN `param5` TINYINT(1), IN `param6` TIME, IN `param7` TIME, IN `param8` VARCHAR(50), IN `param9` TIME)   BEGIN
	INSERT INTO actividades (titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo)
	VALUES (param1, param2, param9, param3, param4, param5, param6, param7, param8);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_todas_actividades` ()   BEGIN
	SELECT id, titulo, fecha, hora, ubicacion, correo, repetir, repetir_inicio, repetir_final, tipo FROM actividades;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `repetir` tinyint(1) NOT NULL,
  `repetir_inicio` time NOT NULL DEFAULT '00:00:00',
  `repetir_final` time NOT NULL DEFAULT '23:59:59',
  `tipo` varchar(50) NOT NULL,
  `hora` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `titulo`, `fecha`, `ubicacion`, `correo`, `repetir`, `repetir_inicio`, `repetir_final`, `tipo`, `hora`, `created_at`, `updated_at`) VALUES
(1, 'Cena Familiar', '2023-10-16', 'Panamá', 'yurianys@gmail.com', 1, '00:00:00', '23:59:59', 'Familiar', '11:47:05', '2022-10-16 16:47:08', '2022-10-16 16:47:09'),
(2, 'Grupo de estudio', '2023-10-17', 'Via España', 'oscar@gmail.com', 1, '00:00:00', '23:59:59', 'Academia', '12:01:41', '2022-10-16 17:01:44', '2022-10-16 17:01:45'),
(7, 'Cena con el jefe 2', '2023-10-19', 'Via argentina', 'jeremi@gmail.com', 1, '00:00:00', '23:59:59', 'Familiar', '19:14:00', '2022-10-17 00:17:01', '2022-10-17 00:17:01'),
(9, 'Caminata por el parque', '2022-11-13', 'Don Bosco', 'yurianys@gmail.com', 1, '00:00:00', '23:59:59', 'Recreacion', '15:43:00', '2022-11-13 20:42:07', '2022-11-13 20:42:07'),
(10, 'Cena de pareja', '2022-11-13', 'Don Bosco', 'oscar@gmail.com', 1, '00:00:00', '23:59:59', 'Familiar', '19:30:00', '2022-11-13 21:32:08', '2022-11-13 21:48:08'),
(11, 'Paseo en la playa', '2022-11-14', 'El chorrillo', 'jeremi@gmail.com', 1, '00:00:00', '23:59:59', 'Laboral', '20:25:00', '2022-11-14 01:26:20', '2022-11-14 01:26:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
