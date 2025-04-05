<?php

require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tipo = $_POST['tipo'];

$sql = "SELECT * FROM users WHERE userlevel = $tipo ORDER BY apellido1, apellido2";

$rowUsuarios = consultaDB_ALL($sql, $db);

$titulo = 'Consulta de usuarios por tipo';
$subtitulo = $rowTipo['descripcion'];


require $baseURL . 'code/accion_consultar_usuarios_generartabla.php';