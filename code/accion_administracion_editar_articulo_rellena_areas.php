<?php

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

if (isset($_POST['departamento'])) {
    $departamento = $_POST['departamento'];
    $sql = "SELECT * FROM areas WHERE departamento = $departamento";

    $rowsAreas = consultaDB_ALL($sql, $db);

    if (sizeof($rowsAreas) > 0) {
        echo '<option value="">Selecciona un área...</option>';
    }

    if (sizeof($rowsAreas) > 0) {
        foreach ((array)$rowsAreas as $area) {
            echo '<option value=' . $area['id_area'] . ' >' . $area['nombre'] . '</option>';
        }
    } else {
        echo '<option>-</option>';
    }
} else if (isset($_GET['departamento'])) {
    $departamento = $_GET['departamento'];
    $sql = "SELECT * FROM areas WHERE departamento = $departamento";

    $rowsAreas = consultaDB_ALL($sql, $db);

    if (sizeof($rowsAreas) > 1) {
        echo '<option value="">Selecciona un área...</option>';
    }

    if (sizeof($rowsAreas) > 0) {
        foreach ((array)$rowsAreas as $area) {
            if ($area['id_area'] == $_GET['area']){
                echo '<option value=' . $area['id_area'] . ' selected>' . $area['nombre'] . '</option>';
            }else{
                echo '<option value=' . $area['id_area'] . ' >' . $area['nombre'] . '</option>';
            }
        }
    } else {
        echo '<option>-</option>';
    }
}
