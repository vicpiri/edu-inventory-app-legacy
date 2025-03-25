<?php
require '../../../code/config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM grupos ORDER BY abreviatura';

$rowsGrupos = consultaDB_ALL($sql, $db);

foreach ($rowsGrupos as $grupo) {
    echo '<option value=' . $grupo['abreviatura'] . ' >' . $grupo['descripcion'] . '</option>';
}
