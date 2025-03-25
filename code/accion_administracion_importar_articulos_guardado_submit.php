<?php
require 'config.php';
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
    if ($_POST['errores_totales'] > 0){
        if (isset($_POST['form'][1])){ //Si existe omitir errores
            $continuar = true;
        }else{
            $continuar = false;
            echo 'errores';
        }
    }else{
        $continuar = true;
    }
    
    $datos = $_POST['datos'];
    print_r($_POST);
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
            foreach((array)$fila as $elemento){
                if(is_array($elemento)){
                    if ($elemento[0] == 1){
                        $error = true;
                    }
                }
            }
            return $error;
        }
        
        foreach ((array)$datos as $key => $articulo){
            //print_r ($_POST['errores'][$key]);
            
            
            if (!comprueba_error_fila($_POST['errores'][$key])){
                //Preparamos la información para ser guardada
                
                if ($_POST['datos'][$key][$_POST['indices']['fungible']] == ""){
                    $fungible = 0;
                }else{
                    $fungible = $_POST['datos'][$key][$_POST['indices']['fungible']];
                }
                $sql = "SELECT * FROM armarios WHERE id_armario=" . $_POST['datos'][$key][$_POST['indices']['ubicacion']];
                $rowArmario = consultaDB($sql, $db);
                $sql = "SELECT * FROM areas WHERE id_area =" . $rowArmario['area'];
                $rowArea = consultaDB($sql, $db);
                
                switch ($_POST['form'][0]['value']) {
                    case 'option1':
                        if($_POST['errores'][$key][$_POST['indices']['articulo']][1] === 'WAR - Este artículo ya existe.'){
                            
                            $sql = "UPDATE articulos SET "
                                    . "id_centro="  . $_POST['datos'][$key][$_POST['indices']['centro']]
                                    . ", id_departamento=" . $rowArea['departamento']
                                    . ", id_area=" .$rowArea['id_area']
                                    . ", id_tipo="  . $_POST['datos'][$key][$_POST['indices']['tipo']]
                                    . ", marca='"  . $_POST['datos'][$key][$_POST['indices']['marca']] . "'"
                                    . ", modelo='"  . $_POST['datos'][$key][$_POST['indices']['modelo']] . "'"
                                    . ", numeroserie='"  . $_POST['datos'][$key][$_POST['indices']['numero de serie']] . "'"
                                    . ", descripcion='"  . $_POST['datos'][$key][$_POST['indices']['descripcion']] . "'"
                                    . ", ubicacion="  . $_POST['datos'][$key][$_POST['indices']['ubicacion']]
                                    . ", foto='"  . $_POST['datos'][$key][$_POST['indices']['foto']] . "'"
                                    . ", observaciones='"  . $_POST['datos'][$key][$_POST['indices']['observaciones']] . "'"
                                    . ", fungible="  . $fungible
                                    . " WHERE id_articulo=" . $_POST['datos'][$key][$_POST['indices']['articulo']];
                            
                            //echo $sql.'</br></br>';
                            
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    //echo "\nPDO::errorInfo(): \n";
                                    //print_r($db->errorInfo());
                                    echo "Problema con la base de datos: " . $db->errorInfo();
                                }else{
                                    $count_actualizados ++;
                                }
                            }catch (PDOException $e) {
                                echo "Problema con la base de datos: " . $e->getMessage();
                            }
                            
                            
                        }else if($_POST['errores'][$key][$_POST['indices']['articulo']] == 0){
                            $disponibilidad = 0;
                            $fecha_alta = date("Y-m-d",time());
                            $usuario_alta = $_POST["user"];
                            
                            $sql = "INSERT INTO articulos ("
                                    . "id_centro, "
                                    . "id_articulo, "
                                    . "id_tipo, "
                                    . "id_departamento, "
                                    . "id_area, "
                                    . "marca, "
                                    . "modelo, "
                                    . "numeroserie, "
                                    . "descripcion, "
                                    . "ubicacion, "
                                    . "foto, "
                                    . "disponibilidad, "
                                    . "fecha_alta, "
                                    . "usuario_alta, "
                                    . "observaciones, "
                                    . "fungible) "
                                    . "VALUES ("
                                    . $_POST['datos'][$key][$_POST['indices']['centro']]. ", "
                                    . $_POST['datos'][$key][$_POST['indices']['articulo']]. ", "
                                    . $_POST['datos'][$key][$_POST['indices']['tipo']]. ", "
                                    . $rowArea['departamento']. ", "
                                    . $rowArea['id_area']. ", "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['marca']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['modelo']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['numero de serie']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['descripcion']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['ubicacion']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['foto']]. "', "
                                    . $disponibilidad. ", "
                                    . "'" . $fecha_alta. "', "
                                    . "'" . $usuario_alta. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['observaciones']]. "', "
                                    . $fungible . ")";
                            //echo $sql.'</br></br>';
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    //echo "\nPDO::errorInfo(): \n";
                                    //print_r($db->errorInfo());
                                    echo "Problema con la base de datos: ";
                                    print_r($db->errorInfo());
                                    echo '</br></br></br></br>';
                                }else{
                                    $count_insertados ++;
                                }
                            }catch (PDOException $e) {
                                echo "Problema con la base de datos: ";
                                print_r($e->getMessage());
                                echo '</br></br></br></br>';
                            }
                            
                        }

                        //echo $sql . '</br>';
                        break;

                    case 'option2':
                        if($_POST['errores'][$key][$_POST['indices']['articulo']][1] === 'WAR - Este artículo ya existe.'){
                            $count_omitidos ++;
                        }else if($_POST['errores'][$key][$_POST['indices']['articulo']] == 0){
                            $disponibilidad = 0;
                            $fecha_alta = date("Y-m-d",time());
                            $usuario_alta = $_POST["user"];
                            
                            $sql = "INSERT INTO articulos ("
                                    . "id_centro, "
                                    . "id_articulo, "
                                    . "id_tipo, "
                                    . "id_departamento, "
                                    . "id_area, "
                                    . "marca, "
                                    . "modelo, "
                                    . "numeroserie, "
                                    . "descripcion, "
                                    . "ubicacion, "
                                    . "foto, "
                                    . "disponibilidad, "
                                    . "fecha_alta, "
                                    . "usuario_alta, "
                                    . "observaciones, "
                                    . "fungible) "
                                    . "VALUES ("
                                    . $_POST['datos'][$key][$_POST['indices']['centro']]. ", "
                                    . $_POST['datos'][$key][$_POST['indices']['articulo']]. ", "
                                    . $_POST['datos'][$key][$_POST['indices']['tipo']]. ", "
                                    . $rowArea['departamento']. ", "
                                    . $rowArea['id_area']. ", "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['marca']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['modelo']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['numero de serie']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['descripcion']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['ubicacion']]. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['foto']]. "', "
                                    . $disponibilidad. ", "
                                    . "'" . $fecha_alta. "', "
                                    . "'" . $usuario_alta. "', "
                                    . "'" . $_POST['datos'][$key][$_POST['indices']['observaciones']]. "', "
                                    . $fungible . ")";
                            //echo $sql.'</br></br>';
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    //echo "\nPDO::errorInfo(): \n";
                                    //print_r($db->errorInfo());
                                    echo "Problema con la base de datos: ";
                                    print_r($db->errorInfo());
                                    echo '</br></br></br></br>';
                                }else{
                                    $count_insertados ++;
                                }
                            }catch (PDOException $e) {
                                echo "Problema con la base de datos: ";
                                print_r($e->getMessage());
                                echo '</br></br></br></br>';
                            }
                        }
                        //echo $sql . '</br>';
                        break;
                    case 'option3':
                        if($_POST['errores'][$key][$_POST['indices']['articulo']][1] === 'WAR - Este artículo ya existe.'){
                          
                            $sql = "UPDATE articulos SET "
                                    . "id_centro="  . $_POST['datos'][$key][$_POST['indices']['centro']]
                                    . ", id_departamento=" . $rowArea['departamento']
                                    . ", id_area=" .$rowArea['id_area']
                                    . ", id_tipo="  . $_POST['datos'][$key][$_POST['indices']['tipo']]
                                    . ", marca='"  . $_POST['datos'][$key][$_POST['indices']['marca']] . "'"
                                    . ", modelo='"  . $_POST['datos'][$key][$_POST['indices']['modelo']] . "'"
                                    . ", numeroserie='"  . $_POST['datos'][$key][$_POST['indices']['numero de serie']] . "'"
                                    . ", descripcion='"  . $_POST['datos'][$key][$_POST['indices']['descripcion']] . "'"
                                    . ", ubicacion="  . $_POST['datos'][$key][$_POST['indices']['ubicacion']]
                                    . ", foto='"  . $_POST['datos'][$key][$_POST['indices']['foto']] . "'"
                                    . ", observaciones='"  . $_POST['datos'][$key][$_POST['indices']['observaciones']] . "'"
                                    . ", fungible="  . $fungible
                                    . " WHERE id_articulo=" . $_POST['datos'][$key][$_POST['indices']['articulo']];
                            
                            //echo $sql.'</br></br>';
                            
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    //echo "\nPDO::errorInfo(): \n";
                                    //print_r($db->errorInfo());
                                    echo "Problema con la base de datos: " . $db->errorInfo();
                                }else{
                                    $count_actualizados ++;
                                }
                            }catch (PDOException $e) {
                                echo "Problema con la base de datos: " . $e->getMessage();
                            }
                        }else if($_POST['errores'][$key][$_POST['indices']['articulo']] == 0){
                            $count_omitidos ++;
                        }
                        //echo $sql . '</br>';
                        break;
                }
            }else{
                $count_erroneos ++;
                //echo ' ERROR';
            }
            //echo '</br>';
        }
        $texto = "Artículos insertados = $count_insertados</br>"
                . "Artículos actualizados = $count_actualizados</br>"
                . "Artículos sin error omitidos = $count_omitidos</br>"
                . "Artículos erróneos omitidos = ". $count_erroneos. "</br>";
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
            
            $('#subframe').load('code/accion_administracion_importar_articulos.php');
        </script>

        <!-- Fin de Modals -->

<?php

    }
}else{
    echo 'Ha habido un error en la transmisión de la información. Vuélvalo a intentar. </br>'
    . 'Si el problema persiste póngase en contacto con el administrador.';
}

//print_r($_POST);
