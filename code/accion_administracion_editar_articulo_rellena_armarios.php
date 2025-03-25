<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

if (isset($_GET['area'])) {
    $area = $_GET['area'];

    $sql = "SELECT * FROM armarios WHERE area = $area";

    $rowsArmarios = consultaDB_ALL($sql, $db);

    echo '<option value="">Selecciona un departamento...</option>';

    foreach ((array)$rowsArmarios as $armario) {
        if ($armario['id_armario'] == $_GET['armario']) {
            echo '<option value=' . $armario['id_armario'] . ' selected>'  
                    . $armario['armario'] . ' - ' . $armario['descripcion'] . '</option>';
        } else {
            echo '<option value=' . $armario['id_armario'] . ' >'  
                    . $armario['armario'] . ' - ' . $armario['descripcion'] . '</option>';
        }
    }
} else if (isset($_POST['area'])) {
    
    $area = $_POST['area'];
    $sql = "SELECT * FROM armarios WHERE area = $area";

    $rowsArmarios = consultaDB_ALL($sql, $db);

    if (sizeof($rowsArmarios)>0){
        echo '<option value="">Selecciona una ubicación...</option>';
    }

    if (sizeof($rowsArmarios)>0){
        foreach ((array)$rowsArmarios as $armario) {
            echo '<option value=' . $armario['id_armario'] . ' >'  
                    . $armario['armario'] . ' - ' . $armario['descripcion'] . '</option>';
        }
    }else{
        echo '<option>-</option>';
    }
}