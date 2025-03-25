<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$departamento = $_POST['departamento'];
$sql = "SELECT * FROM areas WHERE departamento = $departamento";

$rowsAreas = consultaDB_ALL($sql, $db);

if (sizeof($rowsAreas)>1){
    echo '<option value=0>Todos</option>';
}

if (sizeof($rowsAreas)>0){
    foreach ((array)$rowsAreas as $area) {
        echo '<option value=' . $area['id_area'] . ' >' . $area['nombre'] . '</option>';
    }
}else{
    echo '<option>-</option>';
}