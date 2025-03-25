-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-09-2016 a las 09:59:44
-- Versión del servidor: 5.5.50-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_new`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `id` int(11) NOT NULL,
  `id_centro` int(11) NOT NULL DEFAULT '0',
  `id_departamento` int(11) NOT NULL DEFAULT '0',
  `id_area` int(11) NOT NULL DEFAULT '0',
  `id_articulo` bigint(20) NOT NULL DEFAULT '0',
  `id_tipo` int(11) NOT NULL DEFAULT '0',
  `marca` varchar(255) NOT NULL DEFAULT '',
  `modelo` varchar(255) NOT NULL DEFAULT '',
  `numeroserie` varchar(255) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `ubicacion` int(11) NOT NULL DEFAULT '0',
  `foto` varchar(255) NOT NULL DEFAULT 'No_imagen.jpg',
  `disponibilidad` int(11) NOT NULL DEFAULT '0',
  `fecha_alta` date NOT NULL DEFAULT '0000-00-00',
  `usuario_alta` varchar(255) NOT NULL DEFAULT '0',
  `observaciones` text NOT NULL,
  `fungible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
