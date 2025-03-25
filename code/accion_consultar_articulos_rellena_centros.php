<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM centros';

$rowsCentros = consultaDB_ALL($sql, $db);

echo '<option value=0>Todos</option>';
foreach ((array)$rowsCentros as $centro) {
    echo '<option value=' . $centro['id'] . ' >'  
            . $centro['codigo'] . ' - ' . $centro['nombre'] . '</option>';
}
