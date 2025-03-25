<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

if (isset($_GET['file'])){
    
    if(isset($_GET['tipoarchivo'])){
        $separador = $_GET['tipoarchivo'];
    }else{
        $separador = ';';
    }
    
    //Leemos el archivo y guardamos su contenido en el array $datosArchivo  
    

    $row = 0;

    $fp = fopen ($_GET['file'], 'r');

    while ($data = fgetcsv ($fp, 3001, $separador)) {

            $num = count ($data);

            $row++;
            // Convertimos la infomación del archivo a UTF8
            for ($c=0; $c<$num; $c++) {
                    if (mb_detect_encoding($data[$c], 'UTF-8', true)){
                            $datosArchivo[$row][$c] = $data[$c];
                    }else{
                            $datosArchivo[$row][$c] = utf8_encode($data[$c]);
                    }

            }

    }

    fclose ($fp);

    if (unlink($_GET['file'])){
            //echo "Eliminado el temporal... </br>";
    }else{
            echo "<script>";
            echo     "notification('error', 'No se ha podido eliminar el archivo temporal... ','.' , 'fa fa-exclamation');";
            echo "</script>";
    }
        
    //Comprobamos la existencia de las columnas necesarias
    //
    //
    //Configuración de los encabezamientos de las columnas
    $colCentro = 'centro';
    $colArticulo = 'articulo';
    $colTipo = 'tipo';
    $colMarca = 'marca';
    $colModelo = 'modelo';
    $colDescripcion = 'descripcion';
    $colUbicacion = 'ubicacion';
    $colFoto = 'foto';
    $colObservaciones = 'observaciones';
    $colNumSerie = 'numero de serie';
    $colFungible = 'fungible';

    
    if (isset($datosArchivo)){
        //Busqueda de las columnas
        $colCentro = busca_columna($datosArchivo,1 ,$colCentro);
        $colArticulo = busca_columna($datosArchivo,1 ,$colArticulo);
        $colTipo = busca_columna($datosArchivo,1 ,$colTipo);
        $colMarca = busca_columna($datosArchivo,1 ,$colMarca);
        $colModelo = busca_columna($datosArchivo,1 ,$colModelo);
        $colDescripcion = busca_columna($datosArchivo,1 ,$colDescripcion);
        $colUbicacion = busca_columna($datosArchivo,1 ,$colUbicacion);
        $colFoto = busca_columna($datosArchivo,1 ,$colFoto);
        $colObservaciones = busca_columna($datosArchivo,1 ,$colObservaciones);
        $colNumSerie = busca_columna($datosArchivo,1 ,$colNumSerie);
        $colFungible = busca_columna($datosArchivo,1 ,$colFungible);
        
        $indices = [];
        $indices['centro'] = $colCentro;
        $indices['articulo'] = $colArticulo;
        $indices['tipo'] = $colTipo;
        $indices['marca'] = $colMarca;
        $indices['modelo'] = $colModelo;
        $indices['descripcion'] = $colDescripcion;
        $indices['ubicacion'] = $colUbicacion;
        $indices['foto'] = $colFoto;
        $indices['observaciones'] = $colObservaciones;
        $indices['numero de serie'] = $colNumSerie;
        $indices['fungible'] = $colFungible;

        
        //Si existen todas las columnas, procedemos con el análisis
        if (($colCentro > -1) && ($colCentro > -1) && ($colArticulo > -1)
            && ($colTipo > -1) && ($colMarca > -1) && ($colModelo > -1) 
            && ($colDescripcion > -1) && ($colUbicacion > -1) && ($colFoto > -1)
            && ($colObservaciones > -1) && ($colNumSerie > -1) && ($colFungible > -1)){

                //eliminamos las cabeceras de la variable de datos
                $datosArchivo = elimina_cabeceras($datosArchivo);

                //Creamos un duplicado del array donde realizaremos los cambios oportunos
                //Tambi�n preparamos un array para almacenar los errores que encontremos
                $datosFinalesArray = $datosArchivo;
                $datosFinalesErroresArray = array_fill(1, count($datosFinalesArray), array_fill(1, count($datosFinalesArray[1]), 0));




                ///////////////////////////////////////
                //Comprobamos la existencia de las imágenes de los artículos
                //
                //En caso de no existir el archivo en el servidor, anotamos un error en
                //el array de errores: 'Esta imagen no existe todavía en el servidor'. Este
                //tipo de error será de nivel warning. Sí que permite seguir con el proceso
                //////////////////////////////////////

                for($i = 1; $i <= count($datosFinalesArray); $i++){
                        if ($datosArchivo[$i][$colFoto] == ""){

                                $datosFinalesErroresArray[$i][$colFoto] = [0,''];
                                $datosFinalesArray[$i][$colFoto] = 'No_imagen.jpg';

                        }else if ($datosArchivo[$i][$colFoto] == 'No_imagen.jpg'){

                                $datosFinalesErroresArray[$i][$colFoto] =  [0,''];
                                //$datosFinalesErroresArray[$i][$colFoto]['desc'] = 'Se ha asignado ninguna imagen gen&eacute;rica a este art&iacute;culo';
                                //$datosFinalesArray[$i][$colFoto] = 'No_imagen.jpg';

                        }else if (!file_exists('../images/' . $datosFinalesArray[$i][$colFoto])){

                                $datosFinalesErroresArray[$i][$colFoto] = [2, 'WAR - Este archivo no existe todavía en el servidor.'];
                                //$datosFinalesErroresArray[$i][$colFoto]['desc'] = 'No se encuentra el archivo de imagen en el servidor';

                        }

                }


                //////////////////////////////////////
                //Comprobaci�n de los cruces con la tabla Centros e inclusi�n de indices
                ///////////////////////////////////////////
                
                $resultado = cruza_columna($datosArchivo, $datosFinalesArray, $datosFinalesErroresArray, $colCentro, 'centros', 'id', 'nombre');
                $datosFinalesArray = $resultado['finales'];
                $datosFinalesErroresArray = $resultado['errores'];
                

                ///////////////////////////////////////
                //Comprobaci�n de los cruces con la tabla Tipos e inclusi�n de indices
                //////////////////////////////////////

                $resultado = cruza_columna($datosArchivo, $datosFinalesArray, $datosFinalesErroresArray, $colTipo, 'tipos', 'id', 'nombre');
                $datosFinalesArray = $resultado['finales'];
                $datosFinalesErroresArray = $resultado['errores'];


                ///////////////////////////
                //Comprobaci�n de los cruces con la tabla ubicacion e inclusi�n de indices
                ///////////////////////////

                $resultado = cruza_columna($datosArchivo, $datosFinalesArray, $datosFinalesErroresArray, $colUbicacion, 'armarios', 'id_armario', 'armario');
                $datosFinalesArray = $resultado['finales'];
                $datosFinalesErroresArray = $resultado['errores'];
                
                

                ////////////////
                //Comprobaci�n de la existencia de los art�culos a importar en la base de datos
                //////////////////

                for($a = 1; $a <= count($datosFinalesArray); $a++){
                        if ($datosFinalesArray[$a][$colArticulo] <> ''){
                                $sql = 'SELECT * FROM articulos WHERE id_articulo = ' . $datosFinalesArray[$a][$colArticulo];

                                $row = consultaDB($sql, $db);

                                if ($row['id_articulo'] <> ""){

                                        $datosFinalesErroresArray[$a][$colArticulo] = [2, 'WAR - Este artículo ya existe.'];
                                        //echo $a." duplicado</br>";

                                }else{
                                        //echo "noduplicado</br>";
                                }
                        }else{
                                $datosFinalesErroresArray[$a][$colArticulo] =  [2, 'WAR - No hay código de artículo.'];
                        }
                }
                
/*
                //Resumen de errores encontrados en el an�lisis

                require_once '../data/utilidades_insertar_lote_articulos_presentacion.php';

                //Inclusi�n de los art�culos en la base de datos

                if ($errores == 0){
                        require_once '../data/utilidades_insertar_lote_articulos_DB.php';
                }else{
                        require_once '../data/utilidades_insertar_lote_articulos_erroresForm.php';
                }

*/
                //////////
                // Comprobación de que no existen dos entradas en el archivo con el mismo id_articulo
                ///////
                
                for($a = 1; $a <= count($datosFinalesArray); $a++){
                        //Comparamos cada artículo con todos los que quedan por delante
                    
                        for ($b = $a +1; $b <= count($datosFinalesArray); $b++){
                            if ($datosFinalesArray[$a][$colArticulo] === $datosFinalesArray[$b][$colArticulo]){

                                $datosFinalesErroresArray[$a][$colArticulo] = [1, 'ERR - Artículo duplicado en este archivo.'];
                                $datosFinalesErroresArray[$b][$colArticulo] = [1, 'ERR - Artículo duplicado en este archivo.'];
                                
                            }
                        }
                        
                }
                
                require_once '../code/accion_administracion_importar_articulos_presentacion.php';
                
        }else{ //Si no se encuentran todas las columnas necesarias
                //Le damos a conocer al usuario que el archivo que ha proporcinado no contiene todas las columnas necesarias
                echo alerta('El archivo no contiene todas la columnas necesarias. Por favor,'
            . ' revise que el archivo contiene todas las columnas necesarias. Consulte el manual de usuario '
            . 'o pongase en contacto con el administrador del sistema si el problema persiste.', 'danger');
                if ($colCentro == -1){
                    echo alerta('No se encuentra la columna "centro".', 'danger');
                }
                if ($colArticulo == -1){
                    echo alerta('No se encuentra la columna "articulo".', 'danger');
                }
                if ($colTipo == -1){
                    echo alerta('No se encuentra la columna "tipo".', 'danger');
                }
                if ($colMarca == -1){
                    echo alerta('No se encuentra la columna "marca".', 'danger');
                }
                if ($colModelo == -1){
                    echo alerta('No se encuentra la columna "modelo".', 'danger');
                }
                if ($colDescripcion == -1){
                    echo alerta('No se encuentra la columna "descripcion".', 'danger');
                }
                if ($colUbicacion == -1){
                    echo alerta('No se encuentra la columna "ubicacion".', 'danger');
                }
                if ($colFoto == -1){
                    echo alerta('No se encuentra la columna "foto".', 'danger');
                }
                if ($colObservaciones == -1){
                    echo alerta('No se encuentra la columna "observaciones".', 'danger');
                }
                if ($colNumSerie == -1){
                    echo alerta('No se encuentra la columna "numero de serie".', 'danger');
                }
                if ($colFungible == -1){
                    echo alerta('No se encuentra la columna "fungible".', 'danger');
                }
        }
    }else{
        //echo 'Hay problemas con la lectura del archivo. </br>';
        echo "<script>";
        echo     "notification('error', 'Hay problemas con la lectura del archivo.','.' , 'fa fa-exclamation');";
        echo "</script>";
    }


}
echo "<script>$('#loading2').html('2');</script>"; //Paramos el spinner de validación
?>


