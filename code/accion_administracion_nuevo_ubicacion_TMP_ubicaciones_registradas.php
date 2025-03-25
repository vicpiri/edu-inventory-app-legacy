<?php
    require 'config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';

    $sql = 'SELECT * FROM armarios WHERE area = '. $_GET['area'];
    $rowsArmarios = consultaDB_ALL($sql, $db);
    $data = [];
    foreach ((array)$rowsArmarios as $arm){
                
        $armario = [$arm['armario'],  $arm['descripcion']];
        
        array_push($data, $armario);
    }

$header = ['Código de Ubicación', 'Descripción de la ubicación'];
     
?>

<div id="custom-content" class="modal-block modal-block-lg">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class=""></a>
            </span>
            </div>
            <h2 class="panel-title">Ubicaciones registradas para el área seleccionada
            <span class="fa-lg">
                <a id="csvdownload" class="fa fa-cloud-download" href="#"></a></h2>
                <script>
                    $('#csvdownload').click(function(e){
                        e.preventDefault();  //stop the browser from following
                        window.open('<?php echo $baseURLClient ?>code/download_csv_ubicaciones.php?area=<?php echo$_GET['area']; ?>');
                    });
                </script>
            <p class="panel-subtitle">
            </p>
        </header>
        <div class="panel-body">
            <?php echo genera_tabla($header, $data, ''); ?>
        </div>
        <footer class="panel-footer">
            
        </footer>
    </section>
</div>




