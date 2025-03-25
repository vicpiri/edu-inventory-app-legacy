<?php

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

if (isset($_GET['centro'])) {
    $centro = $_GET['centro'];

    $sql = "SELECT * FROM departamentos WHERE centro = $centro";

    $rowsDepartamentos = consultaDB_ALL($sql, $db);

    echo '<option value="">Selecciona un departamento...</option>';

    foreach ((array)$rowsDepartamentos as $departamento) {
        if ($departamento['id_departamento'] == $_GET['departamento']) {
            echo '<option value=' . $departamento['id_departamento'] . ' selected>' . $departamento['abreviatura'] . ' - ' . $departamento['descripcion'] . '</option>';
        } else {
            echo '<option value=' . $departamento['id_departamento'] . ' >' . $departamento['abreviatura'] . ' - ' . $departamento['descripcion'] . '</option>';
        }
    }
} else if (isset($_POST['centro'])) {
    
    $centro = $_POST['centro'];

    $sql = "SELECT * FROM departamentos WHERE centro = $centro";

    $rowsDepartamentos = consultaDB_ALL($sql, $db);

    echo '<option value="">Selecciona un departamento...</option>';

    foreach ((array)$rowsDepartamentos as $departamento) {
        echo '<option value=' . $departamento['id_departamento'] . ' >'
        . $departamento['abreviatura'] . ' - ' . $departamento['descripcion'] . '</option>';
    }
}