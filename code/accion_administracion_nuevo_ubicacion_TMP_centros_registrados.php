<?php
    require 'config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';

    $sql = 'SELECT * FROM centros';
    $rowsCentros = consultaDB_ALL($sql, $db);
    $data = [];
    foreach ((array)$rowsCentros as $cnt){
                
        $centro = [$cnt['nombre'],  $cnt['codigo']];
        
        array_push($data, $centro);
    }

$header = ['Nombre del Centro', 'Código'];
     
?>

<div id="custom-content" class="modal-block modal-block-lg">
    <?php
    
    $contenido = genera_tabla($header, $data, '');
    $tipo = '';
    $icono = '';
    echo genera_panel('Centros registrados en el sistema', '', '', $contenido, '', $tipo, $icono)
    ?>
</div>




