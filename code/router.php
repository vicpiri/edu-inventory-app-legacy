<?php
if (file_exists('../desarrollo.php')){
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

if (isset($_GET['accion'])){ //aquí añadimos la posibilidad de cargar una opción con un método get
    $accion = filter_input(INPUT_GET, 'accion');
    $mode = filter_input(INPUT_GET, 'mode');
}else{
    $accion = filter_input(INPUT_POST, 'data');
    $mode = filter_input(INPUT_POST, 'mode');
}

/* Nota provisional sobre la estructura de la tabla "acciones" de la base de datos
 * 
 * id - identificador de la acción
 * tipo - nodo o acción
 * nombre - nombre de la acción que se mostrará la interfaz
 * menu - booleano que dice si la acción se debe mostrar en le menú de usuario o no
 * parent - identificador del nodo padre de esta acción. 0 si debe estar en el menú superior.
 * codigoaccion - archivo php que maneja la respuesta de la acción
 * nivel - nivel de seguridad para el acceso a esta acción. El nivel más elevado el el 1.
 */

//Comprobamos si existe la acción que intentamos ejecutar
include '../code/config.php';
include '../code/conecta_data_base.php';

//echo $accion;
if (is_numeric($accion)){
    $sql = "SELECT * FROM acciones WHERE id = ". $accion;
}else{
    $sql = "SELECT * FROM acciones WHERE accionkey = '". $accion . "'";
}

try{
    
    $st = $db->query($sql);
    $rowsAccion = $st->fetch();
}catch (Exception $e) {
    print "Problema con la base de datos: " . $e->getMessage();
}

$accionExiste = false;
if ($rowsAccion){
    $accionExiste = true;
}else{

    $nombreSeccion = "Error";
    include('../code/page_mainframe_header.php');
    echo '<div id="subframe">';
    echo '<p>La acción que se está intentando ejecutar no está instalada en el sistema (' . $accion . '). Por favor, póngase en contacto '
    . 'con el administrador.</p>';
    echo '</div>';
}

//Comprobamos si la acción está permitida para el usuario actual
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$accionPermitida = false;
if ($accionExiste){
    if ($_SESSION["userlevel"] <= $rowsAccion['nivel']){
        $accionPermitida = true;
    }
}

//Si el usuario tiene permisos suficientes, consultamos en la base de el archivo
if ($accionPermitida){
    
    if ($mode === 'frame'){

        $nombreSeccion = $rowsAccion['nombre'];
        
        include '../code/page_mainframe_header.php';
    }
    echo '<div id="subframe">';
    
    if ((file_exists('../' . $rowsAccion['codigoaccion'])) && ($rowsAccion['codigoaccion'] <> '')){
        require_once '../code/main_functions.php';
        echo busca_plugin($rowsAccion['accionkey'], 'PRE');
        require '../' . $rowsAccion['codigoaccion'];
        echo busca_plugin($rowsAccion['accionkey'], 'POST');
    }else{
        echo 'No se ha podido ejecutar la acción ' . $rowsAccion['accionkey'] . '. No se ha encontrado el archivo ' . $rowsAccion['codigoaccion'];
    }
    echo '</div>';
}else if ($rowsAccion){//Si no los tiene mostramos un mensaje de error para el usuario
    if ($mode === 'frame'){

        $nombreSeccion = "Error";
        
        include '../code/page_mainframe_header.php';
    }
    echo '<div id="subframe">';
    echo '<p>Error de ejecución de la acción. No tiene permiso para ejecutar este procedimiento.</p>';
    echo '</div>';
}
