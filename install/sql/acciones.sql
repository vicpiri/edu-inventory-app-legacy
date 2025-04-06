-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-09-2016 a las 09:58:30
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
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE IF NOT EXISTS `acciones` (
  `id` int(11) NOT NULL,
  `accionkey` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `paquete` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `menu` tinyint(1) NOT NULL,
  `orden` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `codigoaccion` varchar(255) NOT NULL,
  `nivel` int(11) NOT NULL,
  `icono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id`, `accionkey`, `nombre`, `descripcion`, `version`, `paquete`, `tipo`, `menu`, `orden`, `parent`, `codigoaccion`, `nivel`, `icono`) VALUES

(2, 'PCO00', 'Panel de control', 'Panel de control', '0.1', 'core', 'accion', 1, 1, 0, 'code/accion_panel_control.php', 3, 'fa fa-dashboard'),
(3, 'LOU00', 'Logout', 'Logout', '0.1', 'core', 'accion', 0, 0, 0, 'code/logout.php', 3, ''),
(5, 'CON00', 'Consultar', 'Consultar', '0.1', 'core', 'nodo', 1, 5, 0, '', 2, 'fa fa-search'),
(6, 'ADM00', 'Administración', 'Administración', '0.1', 'core', 'nodo', 1, 6, 0, '', 2, 'fa fa-list-alt'),
(11, 'CON01', 'Usuarios', 'Consultar/Usuarios', '0.1', 'core', 'accion', 1, 0, 5, 'code/accion_consultar_usuarios.php', 2, ''),
(12, 'CON02', 'Artículos', 'Consultar/Artículos', '0.1', 'core', 'accion', 1, 0, 5, 'code/accion_consultar_articulos.php', 2, ''),
(13, 'ADM01', 'Nuevo', 'Administración/Nuevo', '0.1', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(14, 'ADM02', 'Editar', 'Administración/Editar', '0.1', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(15, 'ADM03', 'Importar', 'Administración/Importar', '0.1', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(16, 'ADM04', 'Artículo', 'Administración/Nuevo/Artículo', '0.1', 'core', 'accion', 1, 0, 13, 'code/accion_administracion_nuevo_articulo.php', 1, ''),
(18, 'ADM06', 'Configuración', 'Administración/Configuración', '0.1', 'core', 'nodo', 1, 0, 6, '', 1, ''),
(19, 'ADM07', 'Gestión de módulos', 'Administración/Configuración/Gestión de módulos', '0.1', 'core', 'accion', 1, 0, 18, 'code/accion_administracion_gestion_modulos.php', 1, ''),
(22, 'ADM10', 'Editar mi perfil', 'Administración/Configuración/Editar mi perfil', '0.1', 'core', 'accion', 1, 1, 18, 'code/accion_administracion_editar_perfil.php', 3, ''),
(23, 'ADM11', 'Artículos', 'Administración/Utilidades/Importar Artículos', '0.1', 'core', 'accion', 1, 0, 15, 'code/accion_administracion_importar_articulos.php', 1, ''),
(24, 'ADM12', 'Imágenes de artículo', 'Administración/Utilidades/Importar Imágenes Artículos', '0.1', 'core', 'accion', 1, 0, 15, 'code/accion_administracion_importar_imagenes_articulo.php', 1, ''),
(25, 'ADM13', 'Imágenes de usuario', 'Administración/Utilidades/Importar Imágenes Usuario', '0.1', 'core', 'accion', 1, 0, 15, 'code/accion_administracion_importar_imagenes_usuarios.php', 1, ''),
(26, 'ADM14', 'Artículo', 'Administración/Editar/Artículo', '0.1', 'core', 'accion', 1, 0, 14, 'code/accion_administracion_editar_articulo_form.php', 1, ''),
(29, 'ADM15', 'Ubicación', 'Administración/Editar/Ubicación', '0.1', 'core', 'accion', 1, 2, 14, 'code/accion_administracion_editar_ubicacion.php', 1, ''),
(30, 'ADM16', 'Ubicación', 'Administración/Nuevo/Ubicación', '0.1', 'core', 'accion', 1, 2, 13, 'code/accion_administracion_nuevo_ubicacion.php', 1, ''),
(31, 'ADM17', 'Tipo', 'Administración/Editar/Tipo', '0.1', 'core', 'accion', 1, 2, 14, 'code/accion_administracion_editar_tipo.php', 1, ''),
(32, 'ADM18', 'Tipo', 'Administración/Nuevo/Tipo', '0.1', 'core', 'accion', 1, 2, 13, 'code/accion_administracion_nuevo_tipo.php', 1, ''),
(34, 'ADM20', 'Consultar', 'Administración/Consultar', '0.1', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(35, 'ADM21', 'Actualizaciones disponibles', 'Administración/Consultar/Actualizaciones', '0.1', 'core', 'accion', 1, 2, 34, 'code/accion_administracion_consultar_actualizaciones.php', 1, ''),
(44, 'ADM27', 'Usuario', 'Administración/Editar/Usuario', '0.1', 'core', 'accion', 1, 0, 14, 'code/accion_administracion_editar_usuario_form.php', 1, ''),
(45, 'ADM28', 'Usuario', 'Administración/Nuevo/Usuario', '0.1', 'core', 'accion', 1, 0, 13, 'code/accion_administracion_nuevo_usuario.php', 1, ''),
(46, 'ADM29', 'Usuarios', 'Administración/Utilidades/Usuarios', '0.1', 'core', 'accion', 1, 0, 15, 'code/accion_administracion_importar_usuarios.php', 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
