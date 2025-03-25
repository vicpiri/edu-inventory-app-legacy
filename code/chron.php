<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

//Ejecutamos las acciones chron del CORE


//Ejecutamos las acciones chron de los MODULOS
$modulos = listar_directorios_ruta('../modules/');

foreach ((array)$modulos as $clave => $dato){
    if (file_exists('../modules/' . $dato . '/chron.php')){
        include ('../modules/' . $dato . '/chron.php');
    }
}

