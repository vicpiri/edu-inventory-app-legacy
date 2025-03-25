<?php
require '../../../code/config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

//Comprobamos que hayamos recibido información
if (isset($_POST['datos'])){
    
    //Cargamos toda la informción de los archivos temporales
    $archivo_datos = "$baseURL/temp/" .$_POST['datos'];
    $archivo_errores = "$baseURL/temp/" .$_POST['errores'];
    $archivo_indices = "$baseURL/temp/" .$_POST['indices'];
    $_POST['datos'] = json_decode(file_get_contents($archivo_datos), true);
    $_POST['errores'] = json_decode(file_get_contents($archivo_errores), true);
    $_POST['indices'] = json_decode(file_get_contents($archivo_indices), true);
    

    //Si hay errores comprobamos si se ha marcado la opción de omitir errores
    
    
    $continuar = true;
    if ($_POST['errores_totales'] > 0){
        if (isset($_POST['form'][1])){ //Si existe omitir errores
            $continuar = true;
        }else{
            $continuar = false;
            echo 'errores';
        }
    }
    $datos = $_POST['datos'];
    //Si podemos continuar realizamos el guardado en la base de datos
    if ($continuar){
        unlink($archivo_datos);
        unlink($archivo_errores);
        unlink($archivo_indices);
        $count_insertados = 0;
        $count_actualizados = 0;
        $count_omitidos = 0;
        $count_erroneos = 0;
        
        function comprueba_error_fila($fila){
            $error = false;
            foreach($fila as $elemento){
                if(is_array($elemento)){
                    if ($elemento[0] === 1){
                        $error = true;
                    }
                }
            }
            return $error;
        }
        $texto = 'Es posible que la importación no se haya realizado correctemente.<br/>Tipo de archivo: ' . $_POST['tipo_archivo'];
        switch ($_POST['tipo_archivo']){
            case 'personal':
                include 'accion_importar_usuarios_guardado_submit_personal.php';
                
                break;
            case 'grupos':
                include 'accion_importar_usuarios_guardado_submit_grupos.php';
                break;
            case 'alumnado':
                //$texto = $texto ."<br/>Traza: Seleccionado case alumnado.";
                include 'accion_importar_usuarios_guardado_submit_alumnado.php';
                break;
            default :
                break;
        }
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
                                                <p> <?php echo $texto ?>
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
            
            $('#subframe').load('<?php echo $baseURLClient; ?>modules/itaca/code/accion_importar_usuarios.php');
        </script>

        <!-- Fin de Modals -->

<?php
/**/
    }
}else{
    echo 'Ha habido un error en la transmisión de la información. Vuélvalo a intentar. </br>'
    . 'Si el problema persiste póngase en contacto con el administrador.';
}

//print_r($_POST);
