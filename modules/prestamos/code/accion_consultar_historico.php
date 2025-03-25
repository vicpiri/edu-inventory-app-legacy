<?php
require_once '../../../code/config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';
session_start();

$consulta = $_POST['cadena'];

$sql = "SELECT * FROM salidas WHERE articulo = $consulta ORDER BY fecha DESC";

$rowSalidas = consultaDB_ALL($sql, $db);
$titulo = 'Histórico de préstamos del artículo ' . format_codigobarras($consulta);
$subtitulo = 'Resultados de la búsqueda';

$header = ['Prestado a', 'Prestado por', 'Fecha préstamo', 'Devuelto por', 'Fecha devolución'];

$contenido = [];

foreach ($rowSalidas as $key => $salida) {
    /*$sql = 'SELECT * FROM grupos WHERE abreviatura = "' . $usuario['grupo'] . '"';
    $rowGrupo = consultaDB($sql, $db);
    */
    if ($salida['devuelto'] == 't'){
        $sql = 'SELECT * FROM users WHERE username LIKE "' . $salida['usuario'] . '"';
        $usuario = consultaDB($sql, $db);
        $sql = 'SELECT * FROM users WHERE username LIKE "' . $salida['usuario_presta'] . '"';
        $usuariopresta = consultaDB($sql, $db);
        $sql = 'SELECT * FROM users WHERE username LIKE "' . $salida['usuario_devuelve'] . '"';
        $usuariodevuelve = consultaDB($sql, $db);
        $contenido[$key] = [
            $usuario['nombre'] . ' ' . $usuario['apellido1'] . ' ' . $usuario['apellido2'], 
            $usuariopresta['nombre'] . ' ' . $usuariopresta['apellido1'] . ' ' . $usuariopresta['apellido2'], 
            $salida['fecha'], 
            $usuariodevuelve['nombre'] . ' ' . $usuariodevuelve['apellido1'] . ' ' . $usuariodevuelve['apellido2'], 
            $salida['fecha_devolucion']];
    }else{
        $sql = 'SELECT * FROM users WHERE username LIKE "' . $salida['usuario'] . '"';
        $usuario = consultaDB($sql, $db);
        $sql = 'SELECT * FROM users WHERE username LIKE "' . $salida['usuario_presta'] . '"';
        $usuariopresta = consultaDB($sql, $db);
        
        $contenido[$key] = [
            $usuario['nombre'] . ' ' . $usuario['apellido1'] . ' ' . $usuario['apellido2'], 
            $usuariopresta['nombre'] . ' ' . $usuariopresta['apellido1'] . ' ' . $usuariopresta['apellido2'], 
            $salida['fecha'], '', ''];
    }
}

$datos = genera_tabla($header, $contenido, 0);

echo genera_panel($titulo, $subtitulo, '', $datos, '', 'primario', '');

echo '<script src="java/modals.js" type="text/javascript"></script>';


