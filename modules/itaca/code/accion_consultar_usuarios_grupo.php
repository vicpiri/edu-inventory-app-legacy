<?php

require '../../../code/config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$grupo = $_POST['grupo'];

$sql = "SELECT * FROM grupos WHERE abreviatura = '$grupo'";

$rowGrupo = consultaDB($sql, $db);

$sql = "SELECT matriculas.*, users.* FROM matriculas INNER JOIN users ON matriculas.usuario=users.username WHERE grupo='$grupo' ORDER BY apellido1, apellido2";

$rowUsuarios = consultaDB_ALL($sql, $db);

$titulo = 'Consultar usuarios por Grupo';
$subtitulo = 'Usuarios del grupo '. $rowGrupo['descripcion'] . ' (' . $grupo . ')';


require $baseURL . 'code/accion_consultar_usuarios_generartabla.php';