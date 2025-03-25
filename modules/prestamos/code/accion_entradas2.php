<?php

require_once '../../../code/config.php';
require_once $baseURL . 'code/conecta_data_base.php';

require_once $baseURL . 'code/main_functions.php';
require_once 'module_functions.php';


//Comprobamos si el usuario introducido existe
$usuario_prestamo = (filter_input(INPUT_POST, 'user'));
$sql = 'SELECT * FROM users WHERE username LIKE "' . $usuario_prestamo . '"';

if (isset($db)){
    $rowsUser = consultaDB ($sql, $db);
    if (!$rowsUser){
        echo "<script> notification('error', 'Error de Usuario', 'El usuario indicado no existe', 'fa fa-exclamation') </script>";
        include 'accion_entradas.php';
    }else{
        include 'accion_entradas3.php';
    }    
}else{
    echo "<script> notification('error', 'Error de DB', 'No se encuentra la DB', 'fa fa-exclamation') </script>";
}
