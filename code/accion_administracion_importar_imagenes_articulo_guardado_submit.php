<?php
//Evitamos que se genere un error si superamos el tiempo de ejecución por defecto
//cuando importamos un archivo muy grande
set_time_limit(0);
ignore_user_abort(1);

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

//Comprobamos que hayamos recibido información
if (isset($_POST['directorio'])){
    //Si hay errores comprobamos si se ha marcado la opción de omitir errores
    $directorio = $_POST['directorio'];
    $correctos = $_POST['correctos'];
    $count = 0;
    $texto = '';
    foreach ((array)$correctos as $imagen) {
        $foto = $imagen[0];
        while(file_exists($baseURL . 'images/' . $foto)){

            $nombre = substr($foto, 0, -4);
            $extension = substr($foto, -4);
            $foto = $nombre . '_' . $extension;
        }
        
        rename($imagen[1],$baseURL . 'images/' . $foto);
        $sql = "UPDATE articulos SET foto = '$foto' WHERE id_articulo = $imagen[3]";
        //$texto .= $sql . '<br/>';
        consultaDB($sql, $db);
        
        $sql = "SELECT * FROM articulos WHERE foto = '$foto'"
                . " AND id_articulo = $imagen[3]";
        //$texto .= $sql . '<br/>';
        $rows = consultaDB_ALL($sql, $db);
        
        if (file_exists($baseURL . 'images/' . $foto) && (count($rows) > 0)){
            $count++;
        }
       
    }
    
    $texto .= 'Se han guardado ' . $count . ' imágenes';
    
    array_map('unlink', glob("$directorio/*.*"));
    rmdir($directorio);
    
?>    
        <!-- Modals -->
        <div id="modalResumen" class="modal-block modal-block-success mfp-hide">
                <section class="panel">
                        <header class="panel-heading">
                                <h2 class="panel-title">Importación realizada</h2>
                        </header>
                        <div class="panel-body">
                                <div class="modal-wrapper">
                                        <div class="modal-icon">
                                                <i class="fa fa-check"></i>
                                        </div>
                                        <div class="modal-text">
                                                <h4>Resumen de la importación</h4>
                                                <p> <?php echo $texto; ?>
                                                </p>
                                        </div>
                                </div>
                        </div>
                        <footer class="panel-footer">
                                <div class="row">
                                        <div class="col-md-12 text-right">
                                                <button class="btn btn-success modal-dismiss">OK</button>
                                        </div>
                                </div>
                        </footer>
                </section>
        </div>
        <script>
            $.magnificPopup.open({
                items: {
                    src: '#modalResumen'
                },
                type: 'inline',
                preloader: false,
                modal: true
            }, 0);
            
            $('#subframe').load('code/accion_administracion_importar_imagenes_articulo.php');
        </script>

        <!-- Fin de Modals -->

<?php
}else{
    echo 'Ha habido un error en la transmisión de la información. Vuélvalo a intentar. </br>'
    . 'Si el problema persiste póngase en contacto con el administrador.';
}
