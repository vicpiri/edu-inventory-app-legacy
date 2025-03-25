<?php
//Evitamos que se genere un error si superamos el tiempo de ejecución por defecto
//cuando importamos un archivo muy grande
set_time_limit(0);
ignore_user_abort(1);

$texto = $texto . "<br/>Traza: Iniciado submit_alumnado.";
$erroresDB = 0;
//Eliminamos todas las entradas en matrículas de este tipo de usuarios.

$sql = "DELETE FROM matriculas WHERE NOT (grupo = 'Docente' OR grupo ='Pseudo' OR grupo = 'No Docente')";
try{
    $st = $db->query($sql);
    if (!$st) {
        echo "Problema con la base de datos DELETE: ";
        print_r($db->errorInfo());
        $erroresDB ++;
    }
}catch (PDOException $e) {
    $erroresDB ++;
    echo "Problema con la base de datos DELETE: ";
    print_r($e->getMessage());
}

foreach ($datos as $key => $articulo){
    if (!comprueba_error_fila($_POST['errores'][$key])){
        //Preparamos la información para ser guardada

        switch ($_POST['form'][0]['value']) {
            case 'option1': //Opción de actualizar los existentes e incluir los nuevos
                
                //Comprobamos si el usuario existe en la base de datos
                if($_POST['errores'][$key][$_POST['indices']['NIA']][1] === 'WAR - Este alumno ya existe en el sistema.'){
                    
                    //Actualizamos la tabla de usuarios
                    $sql = "UPDATE users SET "
                            //. "userlevel= 2"
                            . "nombre='" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Nombre']],  MB_CASE_TITLE, 'UTF-8') . "'"
                            . ", apellido1='" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido1']],  MB_CASE_TITLE, 'UTF-8') . "'"
                            . ", apellido2='"  . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido2']],  MB_CASE_TITLE, 'UTF-8') . "'"
                            . ", foto='"  . $_POST['datos'][$key][$_POST['indices']['NIA']] . ".jpg'"
                            //. ", telefono=''"
                            //. ", telefono2=''"
                            . ", fechadenacimiento= STR_TO_DATE('"  . $_POST['datos'][$key][$_POST['indices']['Fecha Nacimiento']] . "', '%d/%m/%Y')"
                            . " WHERE username='" . $_POST['datos'][$key][$_POST['indices']['NIA']] . "'";

                    try{
                        $st = $db->query($sql);
                        if (!$st) {
                            echo "Problema con la base de datos UPDATE: ";
                            print_r($db->errorInfo());
                            $erroresDB ++;
                        }else{
                            
                            $sql = "INSERT INTO matriculas (usuario, grupo) VALUES ('" . $_POST['datos'][$key][$_POST['indices']['NIA']] 
                                    . "', '" . $_POST['datos'][$key][$_POST['indices']['Grupo']] . "')";
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    echo "Problema con la base de datos INSERT matriculas: ";
                                    print_r($db->errorInfo());
                                    $erroresDB ++;
                                }else{
                                    $count_actualizados ++;
                                }
                            }catch (PDOException $e) {
                                $erroresDB ++;
                                echo "Problema con la base de datos UPDATE: ";
                                print_r($e->getMessage());
                            }
                        }
                    }catch (PDOException $e) {
                        $erroresDB ++;
                        echo "Problema con la base de datos UPDATE: ";
                        print_r($e->getMessage());
                    }


                }else if($_POST['errores'][$key][$_POST['indices']['NIA']] == 0){
                    
                    //Insertamos en la tabla de usuarios
                    $sql = "INSERT INTO users ("
                            . "username, "
                            . "password, "
                            . "userlevel, "
                            . "nombre, "
                            . "apellido1, "
                            . "apellido2, "
                            . "foto, "
                            //. "direccion, "
                            . "telefono, "
                            . "telefono2, "
                            . "fechadenacimiento) "
                            . "VALUES ("
                            . "'" . $_POST['datos'][$key][$_POST['indices']['NIA']]. "', "
                            . "'" . password_hash($_POST['datos'][$key][$_POST['indices']['NIA']], PASSWORD_BCRYPT). "', "
                            . "3, "
                            . "'" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Nombre']],  MB_CASE_TITLE, 'UTF-8'). "', "
                            . "'" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido1']],  MB_CASE_TITLE, 'UTF-8'). "', "
                            . "'" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido2']],  MB_CASE_TITLE, 'UTF-8'). "', "
                            . "'" . $_POST['datos'][$key][$_POST['indices']['NIA']]. ".jpg', "
                            //. "'', "
                            . "'', "
                            . "'', "
                            . "STR_TO_DATE('" . $_POST['datos'][$key][$_POST['indices']['Fecha Nacimiento']] . "', '%d/%m/%Y')" . ")";
                    try{
                        $st = $db->query($sql);
                        if (!$st) {
                            echo "Problema con la base de datos INSERT: ";
                            print_r($db->errorInfo());
                            echo '</br></br></br></br>';
                        }else{
                            $sql = "INSERT INTO matriculas (usuario, grupo) VALUES ('" . $_POST['datos'][$key][$_POST['indices']['NIA']] 
                                    . "', '" . $_POST['datos'][$key][$_POST['indices']['Grupo']] . "')";
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    echo "Problema con la base de datos INSERT matriculas: ";
                                    print_r($db->errorInfo());
                                    $erroresDB ++;
                                }else{
                                    $count_insertados ++;
                                }
                            }catch (PDOException $e) {
                                $erroresDB ++;
                                echo "Problema con la base de datos INSERT: ";
                                print_r($e->getMessage());
                            }
                        }
                    }catch (PDOException $e) {
                        $erroresDB ++;
                        echo "Problema con la base de datos INSERT: ";
                        print_r($e->getMessage());
                        echo '</br></br></br></br>';
                    }

                }

                break;

            case 'option2': //Opción de ignorar los existentes e incluir los nuevos
                //Comprobamos si el usuario existe en la base de datos
                if($_POST['errores'][$key][$_POST['indices']['NIA']][1] === 'WAR - Este alumno ya existe en el sistema.'){
                    $count_omitidos ++;
                    
                    $sql = "INSERT INTO matriculas (usuario, grupo) VALUES ('" . $_POST['datos'][$key][$_POST['indices']['NIA']] 
                            . "', '" . $_POST['datos'][$key][$_POST['indices']['Grupo']] . "')";
                    try{
                        $st = $db->query($sql);
                        if (!$st) {
                            echo "Problema con la base de datos INSERT matriculas: ";
                            print_r($db->errorInfo());
                            $erroresDB ++;
                        }
                    }catch (PDOException $e) {
                        $erroresDB ++;
                        echo "Problema con la base de datos UPDATE: ";
                        print_r($e->getMessage());
                    }
                        


                }else if($_POST['errores'][$key][$_POST['indices']['NIA']] == 0){
                    
                    //Insertamos en la tabla de usuarios
                    $sql = "INSERT INTO users ("
                            . "username, "
                            . "password, "
                            . "userlevel, "
                            . "nombre, "
                            . "apellido1, "
                            . "apellido2, "
                            . "foto, "
                            //. "direccion, "
                            . "telefono, "
                            . "telefono2, "
                            . "fechadenacimiento) "
                            . "VALUES ("
                            . "'" . $_POST['datos'][$key][$_POST['indices']['NIA']]. "', "
                            . "'" . password_hash($_POST['datos'][$key][$_POST['indices']['NIA']], PASSWORD_BCRYPT). "', "
                            . "3, "
                            . "'" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Nombre']],  MB_CASE_TITLE, 'UTF-8'). "', "
                            . "'" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido1']],  MB_CASE_TITLE, 'UTF-8'). "', "
                            . "'" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido2']],  MB_CASE_TITLE, 'UTF-8'). "', "
                            . "'" . $_POST['datos'][$key][$_POST['indices']['NIA']]. ".jpg', "
                            //. "'', "
                            . "'', "
                            . "'', "
                            . "STR_TO_DATE('" . $_POST['datos'][$key][$_POST['indices']['Fecha Nacimiento']] . "', '%d/%m/%Y')" . ")";
                    try{
                        $st = $db->query($sql);
                        if (!$st) {
                            echo "Problema con la base de datos INSERT: ";
                            print_r($db->errorInfo());
                            echo '</br></br></br></br>';
                        }else{
                            $sql = "INSERT INTO matriculas (usuario, grupo) VALUES ('" . $_POST['datos'][$key][$_POST['indices']['NIA']] 
                                    . "', '" . $_POST['datos'][$key][$_POST['indices']['Grupo']] . "')";
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    echo "Problema con la base de datos INSERT matriculas: ";
                                    print_r($db->errorInfo());
                                    $erroresDB ++;
                                }else{
                                    $count_insertados ++;
                                }
                            }catch (PDOException $e) {
                                $erroresDB ++;
                                echo "Problema con la base de datos UPDATE: ";
                                print_r($e->getMessage());
                            }
                        }
                    }catch (PDOException $e) {
                        $erroresDB ++;
                        echo "Problema con la base de datos INSERT: ";
                        print_r($e->getMessage());
                        echo '</br></br></br></br>';
                    }

                }

                break;
            case 'option3': //Opción de Actualizar los existentes y omitir los nuevos
                //Comprobamos si el usuario existe en la base de datos
                if($_POST['errores'][$key][$_POST['indices']['NIA']][1] === 'WAR - Este alumno ya existe en el sistema.'){
                    
                    //Actualizamos la tabla de usuarios
                    $sql = "UPDATE users SET "
                            //. "userlevel= 2"
                            . "nombre='" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Nombre']],  MB_CASE_TITLE, 'UTF-8') . "'"
                            . ", apellido1='" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido1']],  MB_CASE_TITLE, 'UTF-8') . "'"
                            . ", apellido2='"  . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Apellido2']],  MB_CASE_TITLE, 'UTF-8') . "'"
                            . ", foto='"  . $_POST['datos'][$key][$_POST['indices']['NIA']] . ".jpg'"
                            //. ", telefono='"  . $_POST['datos'][$key][$_POST['indices']['Teléfono 1']] . "'"
                            //. ", telefono2='"  . $_POST['datos'][$key][$_POST['indices']['Teléfono 2']] . "'"
                            . ", fechadenacimiento= STR_TO_DATE('"  . $_POST['datos'][$key][$_POST['indices']['Fecha Nacimiento']] . "', '%d/%m/%Y')"
                            . " WHERE username='" . $_POST['datos'][$key][$_POST['indices']['NIA']] . "'";

                    try{
                        $st = $db->query($sql);
                        if (!$st) {
                            echo "Problema con la base de datos UPDATE: ";
                            print_r($db->errorInfo());
                            $erroresDB ++;
                        }else{
                            
                            $sql = "INSERT INTO matriculas (usuario, grupo) VALUES ('" . $_POST['datos'][$key][$_POST['indices']['NIA']] 
                                    . "', '" . $_POST['datos'][$key][$_POST['indices']['Grupo']] . "')";
                            try{
                                $st = $db->query($sql);
                                if (!$st) {
                                    echo "Problema con la base de datos INSERT matriculas: ";
                                    print_r($db->errorInfo());
                                    $erroresDB ++;
                                }else{
                                    $count_actualizados ++;
                                }
                            }catch (PDOException $e) {
                                $erroresDB ++;
                                echo "Problema con la base de datos UPDATE: ";
                                print_r($e->getMessage());
                            }
                        }
                    }catch (PDOException $e) {
                        $erroresDB ++;
                        echo "Problema con la base de datos UPDATE: ";
                        print_r($e->getMessage());
                    }


                }else if($_POST['errores'][$key][$_POST['indices']['NIA']] == 0){
                    
                    $count_omitidos ++;
                        $sql = "INSERT INTO matriculas (usuario, grupo) VALUES ('" . $_POST['datos'][$key][$_POST['indices']['NIA']] 
                                . "', '" . $_POST['datos'][$key][$_POST['indices']['Grupo']] . "')";
                        try{
                            $st = $db->query($sql);
                            if (!$st) {
                                echo "Problema con la base de datos INSERT matriculas: ";
                                print_r($db->errorInfo());
                                $erroresDB ++;
                            }else{
                                $count_insertados ++;
                            }
                        }catch (PDOException $e) {
                            $erroresDB ++;
                            echo "Problema con la base de datos UPDATE: ";
                            print_r($e->getMessage());
                        }
                }

                break;
        }
    }else{
        $count_erroneos ++;
    }
}
$texto = "Elementos de Alumnado insertados = $count_insertados</br>"
        . "Elementos de Alumnado actualizados = $count_actualizados</br>"
        . "Elementos de Alumnado sin error omitidos = $count_omitidos</br>"
        . "Elementos de Alumnado erróneos omitidos = ". $count_erroneos. "</br>";

if ($erroresDB > 0){
    $texto = $texto. "Se han producido errores al intentar acceder a la base de datos";
}
        
