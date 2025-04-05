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
--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id`, `accionkey`, `nombre`, `descripcion`, `version`, `paquete`, `tipo`, `menu`, `orden`, `parent`, `codigoaccion`, `nivel`, `icono`) VALUES
(1, 'PRE00', 'Préstamos', 'Préstamos', '1.0', 'prestamos', 'accion', 1, 3, 0, 'modules/prestamos/code/accion_salidas.php', 2, 'fa fa-sign-out'),
(2, 'PCO00', 'Panel de control', 'Panel de control', '1.0', 'core', 'accion', 1, 1, 0, 'code/accion_panel_control.php', 3, 'fa fa-dashboard'),
(3, 'LOU00', 'Logout', 'Logout', '1.0', 'core', 'accion', 0, 0, 0, 'code/logout.php', 3, ''),
(4, 'INC00', 'Incidencias', 'Incidencias', '1.0', 'incidencias', 'nodo', 1, 4, 0, '', 0, 'fa fa-tasks'),
(5, 'CON00', 'Consultar', 'Consultar', '1.0', 'core', 'nodo', 1, 5, 0, '', 2, 'fa fa-search'),
(6, 'ADM00', 'Administración', 'Administración', '1.0', 'core', 'nodo', 1, 6, 0, '', 2, 'fa fa-list-alt'),
(7, 'INC01', 'Nueva(X)', 'Incidencias/Nueva', '1.0', 'incidencias', 'accion', 1, 0, 4, '', 2, ''),
(8, 'INC02', 'Consultar(X)', 'Incidencias/Consultar', '1.0', 'incidencias', 'accion', 1, 0, 4, 'code/basic.html', 2, ''),
(9, 'INC03', 'Editar(X)', 'Incidencias/Editar', '1.0', 'incidencias', 'accion', 1, 0, 4, '', 2, ''),
(10, 'DEV00', 'Devoluciones', 'Devoluciones', '1.0', 'prestamos', 'accion', 1, 2, 0, 'modules/prestamos/code/accion_entradas.php', 2, 'fa fa-sign-in'),
(11, 'CON01', 'Usuarios', 'Consultar/Usuarios', '1.0', 'core', 'accion', 1, 0, 5, 'code/accion_consultar_usuarios.php', 2, ''),
(12, 'CON02', 'Artículos', 'Consultar/Artículos', '1.0', 'core', 'accion', 1, 0, 5, 'code/accion_consultar_articulos.php', 2, ''),
(13, 'ADM01', 'Nuevo', 'Administración/Nuevo', '1.0', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(14, 'ADM02', 'Editar', 'Administración/Editar', '1.0', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(15, 'ADM03', 'Importar', 'Administración/Importar', '1.0', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(16, 'ADM04', 'Artículo', 'Administración/Nuevo/Artículo', '1.0', 'core', 'accion', 1, 0, 13, 'code/accion_administracion_nuevo_articulo.php', 1, ''),
(17, 'ADM05', 'Usuarios ITACA', 'Administración/Importar/Usuarios Itaca', '1.0', 'itaca', 'accion', 1, 0, 15, 'modules/itaca/code/accion_importar_usuarios.php', 1, ''),
(18, 'ADM06', 'Configuración', 'Administración/Configuración', '1.0', '', 'nodo', 1, 0, 6, '', 1, ''),
(19, 'ADM07', 'Gestión de módulos(X)', 'Administración/Configuración/Gestión de módulos', '1.0', 'core', 'accion', 1, 0, 18, 'code/accion_administracion_gestion_modulos.php', 1, ''),
(20, 'ADM08', 'Menú princial(X)', 'Administración/Configuración/Menú Principal', '1.0', 'core', 'accion', 1, 0, 18, '', 1, ''),
(21, 'ADM09', 'Sistema(X)', 'Administración/Configuración/Sistema', '1.0', 'core', 'accion', 1, 0, 18, '', 1, ''),
(22, 'ADM10', 'Editar mi perfil(X)', 'Administración/Configuración/Editar mi perfil', '1.0', 'core', 'accion', 1, 1, 18, '', 3, ''),
(23, 'ADM11', 'Artículos', 'Administración/Utilidades/Importar Artículos', '1.0', 'core', 'accion', 1, 0, 15, 'code/accion_administracion_importar_articulos.php', 1, ''),
(24, 'ADM12', 'Imágenes de artículo', 'Administración/Utilidades/Importar Imágenes Artículos', '1.0', 'core', 'accion', 1, 0, 15, 'code/accion_administracion_importar_imagenes_articulo.php', 1, ''),
(25, 'ADM13', 'Imágenes de usuario', 'Administración/Utilidades/Importar Imágenes Usuario', '1.0', 'core', 'accion', 1, 0, 15, 'code/accion_administracion_importar_imagenes_usuarios.php', 1, ''),
(26, 'ADM14', 'Artículo', 'Administración/Editar/Artículo', '1.0', 'core', 'accion', 1, 0, 14, 'code/accion_administracion_editar_articulo_form.php', 1, ''),
(27, 'DEP00', 'Desarrollo', 'Desarrollo', '1.0', 'core', 'nodo', 1, 10, 0, '', 0, 'fa fa-cogs'),
(28, 'DEP01', 'Scripts cargados', 'Depuración/Scripts Cargados', '1.0', 'core', 'accion-append', 1, 20, 27, 'code/accion_depuracion_scripts_cargados.php', 1, ''),
(29, 'ADM15', 'Ubicación', 'Administración/Editar/Ubicación', '1.0', 'core', 'accion', 1, 2, 14, 'code/accion_administracion_editar_ubicacion.php', 1, ''),
(30, 'ADM16', 'Ubicación', 'Administración/Nuevo/Ubicación', '1.0', 'core', 'accion', 1, 2, 13, 'code/accion_administracion_nuevo_ubicacion.php', 1, ''),
(31, 'ADM17', 'Tipo', 'Administración/Editar/Tipo', '1.0', 'core', 'accion', 1, 2, 14, 'code/accion_administracion_editar_tipo.php', 1, ''),
(32, 'ADM18', 'Tipo', 'Administración/Nuevo/Tipo', '1.0', 'core', 'accion', 1, 2, 13, 'code/accion_administracion_nuevo_tipo.php', 1, ''),
(33, 'ADM19', 'Historial accesos (X)', 'Administración/Consultar/Accesos', '1.0', 'core', 'accion', 1, 2, 34, '', 1, ''),
(34, 'ADM20', 'Consultar', 'Administración/Consultar', '1.0', 'core', 'nodo', 1, 0, 6, '', 2, ''),
(35, 'ADM21', 'Actualizaciones disponibles (X)', 'Administración/Consultar/Actualizaciones', '1.0', 'core', 'accion', 1, 2, 34, 'code/accion_administracion_consultar_actualizaciones.php', 1, ''),
(36, 'DEP02', 'Generar CORE-PACK (X)', 'Depuración/Generar_CORE_PACK', '1.0', 'core', 'accion', 1, 20, 27, 'code/accion_desarrollo_generar_corepack.php', 1, ''),
(37, 'ADM22', 'Deficiencias en la BD (X)', 'Administración/Consultar/Deficiencias DB', '1.0', 'core', 'accion', 1, 2, 34, 'code/accion_consultar_deficienciasDB.php', 1, ''),
(38, 'DEP03', 'Generar MODULE-PACK (X)', 'Depuración/Generar_MODULE-PACK', '1.0', 'core', 'accion', 1, 20, 27, 'code/accion_desarrollo_generar_modulepack.php', 1, ''),
(39, 'ADM23', 'Inventarios', 'Inventarios', '1.0', 'core', 'nodo', 1, 5, 0, '', 0, 'fa fa-archive'),
(40, 'ADM24', 'Nuevo (X)', 'Inventarios/Nuevo', '1.0', 'core', 'accion', 1, 2, 39, '', 2, ''),
(41, 'ADM25', 'Continuar (X)', 'Inventarios/Continuar', '1.0', 'core', 'accion', 1, 2, 39, '', 2, ''),
(42, 'ADM26', 'Consultar (X)', 'Inventarios/Consultar', '1.0', 'core', 'accion', 1, 2, 39, '', 2, ''),
(43, 'DEP04', 'Limpiar DB Usuarios (X)', 'Depuración/Limpiar_DB_Usuarios', '1.0', 'core', 'accion', 1, 20, 27, 'code/accion_desarrollo_limpiar_usuarios.php', 1, ''),
(44, 'ADM27', 'Usuario', 'Administración/Editar/Usuario', '1.0', 'core', 'accion', 1, 0, 14, 'code/accion_administracion_editar_usuario_form.php', 1, '');
