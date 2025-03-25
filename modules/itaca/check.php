<?php
if (!isset($pathroot)){
    $pathroot = '..';
}
include $pathroot . '/code/config.php';
include $pathroot . '/code/conecta_data_base.php';
$modulo_instalado = true;

//Comprobamos que las acciones del módulo están disponibles en la base de datos
if (file_exists($pathroot . '/modules/' . $module . '/acciones.php')){
    include ($pathroot . '/modules/' . $module . '/acciones.php');
    include ($pathroot . '/modules/' . $module . '/info.php');
    foreach ($acciones_modulo as $accion){
        
        $sql = "SELECT * FROM acciones WHERE accionkey LIKE '" . $accion['accionkey'] . "'";
        
        $rows = consultaDB($sql, $db);
        
        if (isset($rows['accionkey'])){
            if (floatval($rows['version'])<> floatval($version_modulo)){
                $modulo_instalado = false;
            }
        }else{
            $modulo_instalado = false;
        }
    }
}else{
    $modulo_instalado = false;
}

//Comprobamos que las tablas del módulo están disponibles en la base de datos
$rutatablas = $pathroot . '/modules/' . $module . '/sql/';

if (is_dir($rutatablas)){ //Si existe una carpeta de tablas, realizamos la comprobación
    
    $files = glob($rutatablas . '*.sql');
    
    foreach ($files as $file) {
        $table = explode('.', basename($file));
        //print_r($table);
        $sql = "SHOW TABLES LIKE '$table[0]'";
        //echo $sql;
        
        $results = consultaDB($sql, $db);
        if ($results){
            if ($table[0] === $results[0]){
                //no pasa nada
            }else{
                $modulo_instalado = false;
            }
            
        }else{
            $modulo_instalado = false;
        }

    }
}