-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2020 a las 11:50:54
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_jorgem`
--
CREATE DATABASE IF NOT EXISTS `proyecto_jorgem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyecto_jorgem`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exposicion`
--

CREATE TABLE `exposicion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `autor` varchar(150) NOT NULL,
  `portada` varchar(200) NOT NULL,
  `num_visitas` int(11) NOT NULL,
  `val_media` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `exposicion`
--

INSERT INTO `exposicion` (`id`, `nombre`, `descripcion`, `autor`, `portada`, `num_visitas`, `val_media`) VALUES
(10, 'p', 'p', '', '', 0, 0),
(11, 'p', 'p', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_usuario` int(11) NOT NULL,
  `id_exposicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(300) NOT NULL,
  `id_exposicion` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra`
--

CREATE TABLE `obra` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `ubicacion` varchar(300) NOT NULL,
  `autor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nick` varchar(150) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `es_Admin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nick`, `contrasena`, `nombre`, `apellidos`, `email`, `es_Admin`) VALUES
(9, 'vstwBUlQ9lcM+8KhnAeqmw==', 'JDJ5JDEwJDFWVlhxWEowaWdaSHdnUzd4L0w4Ty5qMW5OVExZLlRRdVJPd2hYZjRxSWljb212b3ZZZ3p5', 'vstwBUlQ9lcM+8KhnAeqmw==', 'vstwBUlQ9lcM+8KhnAeqmw==', 'vstwBUlQ9lcM+8KhnAeqmw==', '0'),
(10, 'iMd95iTbdkOwWI5Ypbi23A==', 'JDJ5JDEwJFhBV1BFTWdxeE50My5mNXdkU05iSXVzOS90c2FkQUFjU1ZwUFdMWld3TUdlcDh3VkxTajRX', 'iMd95iTbdkOwWI5Ypbi23A==', 'iMd95iTbdkOwWI5Ypbi23A==', 'iMd95iTbdkOwWI5Ypbi23A==', '1'),
(11, 'XSoMl5pprC1VbKSyPwF1Ng==', 'JDJ5JDEwJDN6eHU2UXlmM2lWOVRkY3ZVRzYzdmVnUkZ5UlhidHdiS042VmlwOU9nLkNZNWVaOTBRSWFP', 'XSoMl5pprC1VbKSyPwF1Ng==', 'XSoMl5pprC1VbKSyPwF1Ng==', 'XSoMl5pprC1VbKSyPwF1Ng==', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `id` int(11) NOT NULL,
  `puntuacion` int(5) NOT NULL,
  `contenido` varchar(500) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_exposicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `exposicion`
--
ALTER TABLE `exposicion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `exposicion`
--
ALTER TABLE `exposicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `obra`
--
ALTER TABLE `obra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
