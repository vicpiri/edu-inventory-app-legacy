<?php
include '../../code/config.php';
include '../../code/conecta_data_base.php';
include '../../code/main_functions.php';
/* 
 * install.php
 * 
 * Este archivo contiene todas las acciones necesarias para instalar el módulo.
 */

// Comprobación de dependencias

// Adición y refresco de las entradas en la base de datos de acciones
include 'info.php';
include 'acciones.php';

    foreach ($acciones_modulo as $accion){
        
        $sql = "SELECT * FROM acciones WHERE accionkey LIKE '" . $accion['accionkey'] . "'";
        
        $rows = consultaDB($sql, $db);
        
        if (isset($rows['accionkey'])){
            $sql = "UPDATE acciones SET "
                    . "nombre= '" . $accion['nombre'] . "',"
                    . "descripcion = '" . $accion['descripcion'] . "',"
                    . "version = '" . $accion['version'] . "',"
                    . "paquete = '" . $accion['paquete'] . "',"
                    . "tipo = '" . $accion['tipo'] . "',"
                    . "menu = " . $accion['menu'] . ","
                    . "orden = " . $accion['orden'] . ","
                    . "parent = " . $accion['parent'] . ","
                    . "codigoaccion = '" . $accion['codigoaccion'] . "',"
                    . "nivel = " . $accion['nivel'] . ","
                    . "icono = '" . $accion['icono'] . "'"
                    . "WHERE accionkey='" . $accion['accionkey'] . "'";
            //echo $sql;
            $rows = consultaDB($sql, $db);
        }else{
            $sql = "INSERT INTO acciones ("
                    . "accionkey, "
                    . "nombre, "
                    . "descripcion, "
                    . "version, "
                    . "paquete ,"
                    . "tipo ,"
                    . "menu ,"
                    . "orden ,"
                    . "parent ,"
                    . "codigoaccion ,"
                    . "nivel ,"
                    . "icono) VALUES ("
                    . "'" . $accion['accionkey'] . "',"
                    . "'" . $accion['nombre'] . "',"
                    . "'" . $accion['descripcion'] . "',"
                    . "'" . $accion['version'] . "',"
                    . "'" . $accion['paquete'] . "',"
                    . "'" . $accion['tipo'] . "',"
                    . "" . $accion['menu'] . ","
                    . "" . $accion['orden'] . ","
                    . "" . $accion['parent'] . ","
                    . "'" . $accion['codigoaccion'] . "',"
                    . "" . $accion['nivel'] . ","
                    . "'" . $accion['icono'] . "'"
                    . ")";
            //echo $sql;
            $results = $db->query($sql);
            if(!$results) {
                die(print_r($db->errorInfo(), TRUE));
            }
        }
    }
// Instalación de tablas nuevas en la base de datos
$files = glob('./sql/*.sql');

foreach ($files as $file) {
    $table = explode('.', basename($file));
    //print_r($table);
    $results = $db->query("SHOW TABLES LIKE '$table[0]'");
    if(!$results) {
        die(print_r($db->errorInfo(), TRUE));
    }
    if($results->rowCount()>0) {
        //echo "La tabla $table[0] ya existe. </br>";
    }else{
        $filename = $file;
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($filename);
        // Loop through each line
        foreach ($lines as $line)
        {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            $db->query($templine);
            // Reset temp variable to empty
            $templine = '';
        }
        }
         //echo "Se ha ejecutado el archivo " . $filename . " correctamente.<br />";
    }
}

// Actualización de tablas existentes en la base de datos

// Recargamos la página de gestión
include '../../code/accion_administracion_gestion_modulos.php';