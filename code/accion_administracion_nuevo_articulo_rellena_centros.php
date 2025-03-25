<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM centros';

$rowsCentros = consultaDB_ALL($sql, $db);

if (sizeof($rowsCentros)>0){
    echo '<option value="">Selecciona un centro...</option>';
}

if (isset($_GET['centro'])){
    foreach ((array)$rowsCentros as $centro) {
    
    if ($_GET['centro'] == $centro['id']){
        echo '<option value=' . $centro['id'] . ' selected>' . $centro['codigo'] . ' - ' . $centro['nombre'] . '</option>';
    }else{
        echo '<option value=' . $centro['id'] . ' >' . $centro['codigo'] . ' - ' . $centro['nombre'] . '</option>';
    }
}
}else{
    foreach ((array)$rowsCentros as $centro) {
    echo '<option value=' . $centro['id'] . ' >' . $centro['codigo'] . ' - ' . $centro['nombre'] . '</option>';
}
}


