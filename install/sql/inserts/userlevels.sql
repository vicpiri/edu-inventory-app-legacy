-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-09-2016 a las 10:01:22
-- Versión del servidor: 5.5.50-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Volcado de datos para la tabla `userlevels`
--

INSERT INTO `userlevels` (`id_userlevel`, `descripcion`, `level`) VALUES
(1, 'Administrador', 1),
(2, 'Profesor', 2),
(3, 'Alumno', 3),
(4, 'Superusuario', 0);
