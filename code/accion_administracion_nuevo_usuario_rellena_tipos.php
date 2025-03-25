<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM userlevels WHERE level > ' . $_GET['userlevel'];

$rowsTipos = consultaDB_ALL($sql, $db);

if (sizeof($rowsTipos)>0){
    echo '<option value="">Selecciona un tipo de usuario...</option>';
}

foreach ((array)$rowsTipos as $tipo) {
    echo '<option value=' . $tipo['level'] . ' >' . $tipo['descripcion'] . '</option>';
}
