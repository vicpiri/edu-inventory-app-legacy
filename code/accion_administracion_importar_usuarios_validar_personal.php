<?php

echo '<strong>Análisis del archivo de Personal de Ítaca:</strong><br/><br/>';

echo "<script type='text/javascript'>";
echo "var tipo_archivo = ". json_encode('personal') .";\n";
echo "</script>";
    //Comprobamos la existencia de las columnas necesarias
    //
    //
    //Configuración de los encabezamientos de las columnas
    $colTipo = 'Función';
    $colDocumento = 'Documento';
    $colNombre = 'Nombre';
    $colApellido1 = 'Apellido1';
    $colApellido2 = 'Apellido2';
    $colFecha_Nacimiento = 'Fecha Nacimiento';
    $colTelefono1 = 'Teléfono 1';
    $colTelefono2 = 'Teléfono 2';
    $colEmail = 'Email';
    
    if (isset($datosArchivo)){
        //Busqueda de las columnas
        $colTipo = busca_columna($datosArchivo,1 ,$colTipo);
        
        $colDocumento = busca_columna($datosArchivo,1 ,$colDocumento);
        
        $colNombre = busca_columna($datosArchivo,1 ,$colNombre);
        
        $colApellido1 = busca_columna($datosArchivo,1 ,$colApellido1);
        
        $colApellido2 = busca_columna($datosArchivo,1 ,$colApellido2);
        
        $colFecha_Nacimiento = busca_columna($datosArchivo,1 ,$colFecha_Nacimiento);
        
        $colTelefono1 = busca_columna($datosArchivo,1 ,$colTelefono1);
        
        $colTelefono2 = busca_columna($datosArchivo,1 ,$colTelefono2);
        
        $colEmail = busca_columna($datosArchivo,1 ,$colEmail);
        
        
        $indices = [];
        $indices['Tipo'] = $colTipo;
        $indices['Documento'] = $colDocumento;
        $indices['Nombre'] = $colNombre;
        $indices['Apellido1'] = $colApellido1;
        $indices['Apellido2'] = $colApellido2;
        $indices['Fecha Nacimiento'] = $colFecha_Nacimiento;
        $indices['Teléfono 1'] = $colTelefono1;
        $indices['Teléfono 2'] = $colTelefono2;
        $indices['Email'] = $colEmail;

        
        //Si existen todas las columnas, procedemos con el análisis
        if (($colTipo > -1) && ($colDocumento > -1) && ($colNombre > -1)
            && ($colApellido1 > -1) && ($colApellido2 > -1) && ($colFecha_Nacimiento > -1) 
            && ($colTelefono1 > -1) && ($colTelefono2 > -1) && ($colEmail > -1)){

                //eliminamos las cabeceras de la variable de datos
                $datosArchivo = elimina_cabeceras($datosArchivo);

                //Creamos un duplicado del array donde realizaremos los cambios oportunos
                //Tambi�n preparamos un array para almacenar los errores que encontremos
                $datosFinalesArray = $datosArchivo;
                $datosFinalesErroresArray = array_fill(1, count($datosFinalesArray), array_fill(1, count($datosFinalesArray[1]), 0));

                                
                ///////
                // Comprobamos si los alumnos existen en el sistema para advertir al usuario
                ///////
                
                function existe_usuario($user, &$db){
                    
                    
                    $user2 = substr($user, 0, -1);
                    $user2 = substr($user2, 1);
                    
                    $sql = "SELECT * FROM users WHERE username='$user2'";
                    
                    $rowUsuario = consultaDB_ALL($sql, $db);
                    
                    if (count($rowUsuario) > 0){
                        return true;
                    }else{
                        $sql = "SELECT * FROM users WHERE username='$user'";
                        $rowUsuario = consultaDB_ALL($sql, $db);
                        if (count($rowUsuario) > 0){
                            return true;
                        }else{
                            return false;
                        }
                    }
                    
                }
                
                for ($i = 1; $i <= count($datosArchivo); $i++){
                    if (existe_usuario($datosArchivo[$i][$colDocumento], $db)){
                        $datosFinalesErroresArray[$i][$colDocumento] = [2, 'WAR - Este usuario ya existe en el sistema.'];
                    }
                }
                
                //////////
                // Comprobación de que no existen dos entradas en el archivo con el mismo id_articulo
                ///////
                
                for($a = 1; $a <= count($datosFinalesArray); $a++){
                        //Comparamos cada artículo con todos los que quedan por delante
                    
                        for ($b = $a +1; $b <= count($datosFinalesArray); $b++){
                            if ($datosFinalesArray[$a][$colDocumento] === $datosFinalesArray[$b][$colDocumento]){

                                $datosFinalesErroresArray[$a][$colDocumento] = [2, 'WAR - Usuario duplicado en este archivo.'];
                                $datosFinalesErroresArray[$b][$colDocumento] = [2, 'WAR - Usuario duplicado en este archivo.'];
                                
                            }
                        }
                        
                }
                
                require_once 'accion_administracion_importar_usuarios_presentacion.php';

        }else{ //Si no se encuentran todas las columnas necesarias
                //Le damos a conocer al usuario que el archivo que ha proporcinado no contiene todas las columnas necesarias
                echo alerta('El archivo no contiene todas la columnas necesarias. Por favor,'
            . ' revise que el archivo contiene todas las columnas necesarias. Consulte el manual de usuario '
            . 'o pongase en contacto con el administrador del sistema si el problema persiste.', 'danger');
                if ($colTipo == -1){
                    echo alerta('No se encuentra la columna "NIA".', 'danger');
                }
                if ($colNombre == -1){
                    echo alerta('No se encuentra la columna "Nombre".', 'danger');
                }
                if ($colApellido1 == -1){
                    echo alerta('No se encuentra la columna "Apellido1".', 'danger');
                }
                if ($colApellido2 == -1){
                    echo alerta('No se encuentra la columna "Apellido2".', 'danger');
                }
                if ($colFecha_Nacimiento == -1){
                    echo alerta('No se encuentra la columna "Fecha Nacimiento".', 'danger');
                }
                if ($colDocumento == -1){
                    echo alerta('No se encuentra la columna "Documento".', 'danger');
                }
                if ($colTelefono1 == -1){
                    echo alerta('No se encuentra la columna "Telefono 1".', 'danger');
                }
                if ($colTelefono2 == -1){
                    echo alerta('No se encuentra la columna "Telefono 2".', 'danger');
                }
                
                if ($colEmail == -1){
                    echo alerta('No se encuentra la columna "Email".', 'danger');
                }
                
        }
    }else{
        //echo 'Hay problemas con la lectura del archivo. </br>';
        echo "<script>";
        echo     "notification('error', 'Hay problemas con la lectura del archivo.','.' , 'fa fa-exclamation');";
        echo "</script>";
    }

