-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-09-2016 a las 09:59:28
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
-- Estructura de tabla para la tabla `armarios`
--

CREATE TABLE IF NOT EXISTS `armarios` (
  `id_armario` int(11) NOT NULL,
  `area` int(11) NOT NULL DEFAULT '0',
  `armario` varchar(25) NOT NULL DEFAULT '0',
  `descripcion` varchar(255) NOT NULL DEFAULT '',
  `plano` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `armarios`
--
ALTER TABLE `armarios`
  ADD PRIMARY KEY (`id_armario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `armarios`
--
ALTER TABLE `armarios`
  MODIFY `id_armario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
