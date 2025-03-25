<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM departamentos';

$rowsDepartamentos = consultaDB_ALL($sql, $db);

echo '<option value=0>Todos</option>';
foreach ((array)$rowsDepartamentos as $departamento) {
    echo '<option value=' . $departamento['id_departamento'] . ' >'  
            . $departamento['abreviatura'] . ' - ' . $departamento['descripcion'] . '</option>';
}
