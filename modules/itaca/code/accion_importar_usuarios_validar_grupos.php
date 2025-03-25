<?php
echo '<strong>Análisis del archivo de Grupos de Ítaca:</strong><br/><br/>';

echo "<script type='text/javascript'>";
echo "var tipo_archivo = ". json_encode('grupos') .";\n";
echo "$('#formGuardado').html('');\n";
echo "$('#alertGuardado').html('<strong>¡Atención!</strong><br/><br/>";
echo "        Cuando pulse <strong>Finalizar</strong> se restaurarán los grupos del sistema con los valores del archivo. También se eliminará la";
echo "        información que asocia a cada alumno con un grupo, por lo que después deberá importar el archivo de alumnado.<br/><br/>";
echo "        Si está seguro de lo que está haciendo, pulse <strong>Finalizar</strong> para ejecutar la acción.');\n";
echo "</script>";

    //Comprobamos la existencia de las columnas necesarias
    //
    //
    //Configuración de los encabezamientos de las columnas
    $colCodigo = 'Código';
    $colNombre = 'Nombre';
    $colTutor = 'Tutor';
    
    if (isset($datosArchivo)){
        //Busqueda de las columnas
        $colCodigo = busca_columna($datosArchivo,1 ,$colCodigo);
        if ($colCodigo < 0) {
            $colCodigo = 'Codi';
            $colCodigo = busca_columna($datosArchivo,1 ,$colCodigo);
        }
        $colNombre = busca_columna($datosArchivo,1 ,$colNombre);
        if ($colNombre < 0) {
            $colNombre = 'Nom';
            $colNombre = busca_columna($datosArchivo,1 ,$colNombre);
        }
        $colTutor = busca_columna($datosArchivo,1 ,$colTutor);
        if ($colTutor < 0) {
            $colTutor = 'Tutor';
            $colTutor = busca_columna($datosArchivo,1 ,$colTutor);
        }
        
        
        $indices = [];
        $indices['Código'] = $colCodigo;
        $indices['Nombre'] = $colNombre;
        $indices['Tutor'] = $colTutor;
                
        //Si existen todas las columnas, procedemos con el análisis
        if (($colCodigo > -1) && ($colNombre > -1) && ($colTutor > -1)){

                //eliminamos las cabeceras de la variable de datos
                $datosArchivo = elimina_cabeceras($datosArchivo);

                //Creamos un duplicado del array donde realizaremos los cambios oportunos
                //Tambi�n preparamos un array para almacenar los errores que encontremos
                $datosFinalesArray = $datosArchivo;
                $datosFinalesErroresArray = array_fill(1, count($datosFinalesArray), array_fill(1, count($datosFinalesArray[1]), 0));

                                
                ///////
                // Comprobamos si los alumnos existen en el sistema para advertir al usuario
                ///////
                
                function existe_grupo($grupo, &$db){
                    $sql = "SELECT * FROM grupos WHERE abreviatura='$grupo'";
                    
                    $rowGrupo = consultaDB_ALL($sql, $db);

                    if (count($rowGrupo) > 0){
                        return true;
                    }else{
                        return false;
                    }
                    
                }
                
                for ($i = 1; $i <= count($datosArchivo); $i++){
                    if (existe_grupo($datosArchivo[$i][$colCodigo], $db)){
                        $datosFinalesErroresArray[$i][$colCodigo] = [2, 'WAR - Este grupo ya existe en el sistema.'];
                    }
                }
                
                //////////
                // Comprobación de que no existen dos entradas en el archivo con el mismo id_articulo
                ///////
                
                for($a = 1; $a <= count($datosFinalesArray); $a++){
                        //Comparamos cada artículo con todos los que quedan por delante
                    
                        for ($b = $a +1; $b <= count($datosFinalesArray); $b++){
                            if ($datosFinalesArray[$a][$colCodigo] === $datosFinalesArray[$b][$colCodigo]){

                                $datosFinalesErroresArray[$a][$colCodigo] = [2, 'WAR - Grupo duplicado en este archivo.'];
                                $datosFinalesErroresArray[$b][$colCodigo] = [2, 'WAR - Grupo duplicado en este archivo.'];
                                
                            }
                        }
                        
                }
                
                require_once '../code/accion_importar_usuarios_presentacion.php';

        }else{ //Si no se encuentran todas las columnas necesarias
                //Le damos a conocer al usuario que el archivo que ha proporcinado no contiene todas las columnas necesarias
                echo alerta('El archivo no contiene todas la columnas necesarias. Por favor,'
            . ' revise que el archivo contiene todas las columnas necesarias. Consulte el manual de usuario '
            . 'o pongase en contacto con el administrador del sistema si el problema persiste.', 'danger');
                if ($colCodigo == -1){
                    echo alerta('No se encuentra la columna "Código".', 'danger');
                }
                if ($colNombre == -1){
                    echo alerta('No se encuentra la columna "Nombre".', 'danger');
                }
                if ($colTutor == -1){
                    echo alerta('No se encuentra la columna "Tutor".', 'danger');
                }
                
        }
    }else{
        //echo 'Hay problemas con la lectura del archivo. </br>';
        echo "<script>";
        echo     "notification('error', 'Hay problemas con la lectura del archivo.','.' , 'fa fa-exclamation');";
        
        echo "</script>";
    }
