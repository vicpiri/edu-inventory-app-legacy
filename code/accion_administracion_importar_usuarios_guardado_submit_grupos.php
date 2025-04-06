<?php
$texto = $texto . "<br/>Traza: Iniciado submit_alumnado.";
$erroresDB = 0;
//Eliminamos todas las entradas en matrículas de este tipo de usuarios.

$sql = "DELETE FROM matriculas WHERE NOT (grupo = 'Docente' OR grupo ='Pseudo' OR grupo = 'No_Docente')";
try{
    $st = $db->query($sql);
    if (!$st) {
        echo "Problema con la base de datos Borrando matrículas: ";
        print_r($db->errorInfo());
        $erroresDB ++;
    }
}catch (PDOException $e) {
    $erroresDB ++;
    echo "Problema con la base de datos Borrando matrículas: ";
    print_r($e->getMessage());
}

//Eliminamos todas las entradas de grupos e insertamos los de Docente y No Docente
$sql = "DELETE FROM grupos WHERE 1";

try{
    $st = $db->query($sql);
    if (!$st) {
        echo "Problema con la base de datos Borrando grupos: ";
        print_r($db->errorInfo());
        $erroresDB ++;
    }
}catch (PDOException $e) {
    $erroresDB ++;
    echo "Problema con la base de datos Borrando grupos: ";
    print_r($e->getMessage());
}

$sql = "INSERT INTO grupos ("
        . "descripcion, "
        . "abreviatura, "
        . "tutor) "
        . "VALUES ("
        . "'Profesores', "
        . "'Docente', "
        . "'')";
try{
    $st = $db->query($sql);
    if (!$st) {
        echo "Problema con la base de datos Insertando grupos: ";
        print_r($db->errorInfo());
        $erroresDB ++;
    }
}catch (PDOException $e) {
    $erroresDB ++;
    echo "Problema con la base de datos Insertando grupos: ";
    print_r($e->getMessage());
}

$sql = "INSERT INTO grupos ("
        . "descripcion, "
        . "abreviatura, "
        . "tutor) "
        . "VALUES ("
        . "'Personal no docente', "
        . "'No_Docente', "
        . "'')";

try{
    $st = $db->query($sql);
    if (!$st) {
        echo "Problema con la base de datos Insertando grupos: ";
        print_r($db->errorInfo());
        $erroresDB ++;
    }
}catch (PDOException $e) {
    $erroresDB ++;
    echo "Problema con la base de datos Insertando grupos: ";
    print_r($e->getMessage());
}


foreach ($datos as $key => $articulo){
    if (!comprueba_error_fila($_POST['errores'][$key])){
        //Preparamos la información para ser guardada

        $sql = "INSERT INTO grupos ("
                . "descripcion, "
                . "abreviatura, "
                . "tutor) "
                . "VALUES ("
                . "'" . $_POST['datos'][$key][$_POST['indices']['Nombre']]. "', "
                . "'" . $_POST['datos'][$key][$_POST['indices']['Código']]. "', "
                . "'" . mb_convert_case($_POST['datos'][$key][$_POST['indices']['Tutor']],  MB_CASE_TITLE, 'UTF-8'). "')";
        try{
            $st = $db->query($sql);
            if (!$st) {
                echo "Problema con la base de datos INSERT: ";
                print_r($db->errorInfo());
                echo '</br></br></br></br>';
            }else{
                $count_insertados ++;
            }
        }catch (PDOException $e) {
            $erroresDB ++;
            echo "Problema con la base de datos INSERT: ";
            print_r($e->getMessage());
            echo '</br></br></br></br>';
        }

    }else{
        $count_erroneos ++;
    }
}
$texto = "Elementos de Grupos insertados = $count_insertados</br>"
        . "Elementos de Grupos erróneos omitidos = ". $count_erroneos. "</br>";

if ($erroresDB > 0){
    $texto = $texto. "Se han producido errores al intentar acceder a la base de datos";
}
        
