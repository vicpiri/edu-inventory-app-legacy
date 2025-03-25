<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

session_start();
$minivel = $_SESSION['userlevel'];

$sql = 'SELECT * FROM users WHERE username = "' . $_GET['editeduser'] . '"';
$rowsUser = consultaDB($sql, $db);

$niveleditado = $rowsUser['userlevel'];

if ($minivel >= $niveleditado){
    $sql = 'SELECT * FROM userlevels';

    $rowsTipos = consultaDB_ALL($sql, $db);

    $sql = 'SELECT * FROM users WHERE username = "' . $_GET['editeduser'] . '"';

    $rowsUser = consultaDB($sql, $db);

    foreach ((array)$rowsTipos as $tipo) {

        if ($tipo['level'] == $rowsUser['userlevel']){
            echo '<option value=' . $tipo['level'] . ' selected>' . $tipo['descripcion'] . '</option>';
        }
    }
}else{
    $sql = 'SELECT * FROM userlevels WHERE level > ' . $_GET['userlevel'];

    $rowsTipos = consultaDB_ALL($sql, $db);

    $sql = 'SELECT * FROM users WHERE username = "' . $_GET['editeduser'] . '"';

    $rowsUser = consultaDB($sql, $db);

    foreach ((array)$rowsTipos as $tipo) {

        if ($tipo['level'] == $rowsUser['userlevel']){
            echo '<option value=' . $tipo['level'] . ' selected>' . $tipo['descripcion'] . '</option>';
        }else{
            echo '<option value=' . $tipo['level'] . ' >' . $tipo['descripcion'] . '</option>';
        }
    }
}

//Compruebo mi nivel de usuario
//
//
//Compruebo el nivel del usuario editado
//Si mi nivel es el mismo que el del usuario, no puedo editar el nivel del usuario
//Si mi nivel es superior al del usuario listo todos los niveles menores que mi nivel