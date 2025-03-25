<?php
    require 'config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';

    $sql = 'SELECT * FROM areas WHERE departamento = '. $_GET['departamento'];
    $rowsAreas = consultaDB_ALL($sql, $db);
    $data = [];
    foreach ((array)$rowsAreas as $are){
                
        $area = [$are['nombre']];
        
        array_push($data, $area);
    }

$header = ['Nombre del Área'];
     
?>

<div id="custom-content" class="modal-block modal-block-lg">
    <?php
    
    $contenido = genera_tabla($header, $data, '');
    $tipo = '';
    $icono = '';
    echo genera_panel('Áreas registradas para el departamento seleccionado', '', '', $contenido, '', $tipo, $icono)
    ?>
</div>




