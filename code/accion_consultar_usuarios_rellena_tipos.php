<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM userlevels WHERE level >= 1';

$rowsTipos = consultaDB_ALL($sql, $db);

foreach ((array)$rowsTipos as $tipo) {
    echo '<option value=' . $tipo['level'] . ' >' . $tipo['descripcion'] . '</option>';
}
