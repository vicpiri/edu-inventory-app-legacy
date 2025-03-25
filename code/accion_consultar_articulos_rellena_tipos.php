<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM tipos';

$rowsTipos = consultaDB_ALL($sql, $db);

foreach ((array)$rowsTipos as $tipo) {
    echo '<option value=' . $tipo['id'] . ' >' . $tipo['nombre'] . '</option>';
}
