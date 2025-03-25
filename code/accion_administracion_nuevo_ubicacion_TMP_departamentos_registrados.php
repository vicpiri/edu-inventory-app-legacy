<?php
    require 'config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';

    $sql = 'SELECT * FROM departamentos WHERE centro = ' . $_GET['centro'];
    $rowsDepartamentos = consultaDB_ALL($sql, $db);
    $data = [];
    foreach ((array)$rowsDepartamentos as $dep){
                
        $departamento = [$dep['abreviatura'],  $dep['descripcion']];
        
        array_push($data, $departamento);
    }

$header = ['Abreviatura', 'Nombre'];
     
?>

<div id="custom-content" class="modal-block modal-block-lg">
    <?php
    
    $contenido = genera_tabla($header, $data, '');
    $tipo = '';
    $icono = '';
    echo genera_panel('Departamentos registrados para el Centro actual', '', '', $contenido, '', $tipo, $icono)
    ?>
</div>




