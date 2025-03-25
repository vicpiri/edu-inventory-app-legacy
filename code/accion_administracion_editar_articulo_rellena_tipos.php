<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM tipos';

$rowsTipos = consultaDB_ALL($sql, $db);


if (isset($_GET['tipo'])){
    if (sizeof($rowsTipos)>0){
        echo '<option value="">Selecciona un tipo de artículo...</option>';
    }

    foreach ((array)$rowsTipos as $tipo) {
        if ($_GET['tipo'] == $tipo['id']){
            echo '<option value=' . $tipo['id'] . ' selected>' . $tipo['nombre'] . '</option>';
        }else{
            echo '<option value=' . $tipo['id'] . ' >' . $tipo['nombre'] . '</option>';
        }
    }
}else{
    if (sizeof($rowsTipos)>0){
        echo '<option value="">Selecciona un tipo de artículo...</option>';
    }

    foreach ((array)$rowsTipos as $tipo) {
        echo '<option value=' . $tipo['id'] . ' >' . $tipo['nombre'] . '</option>';
    }
}