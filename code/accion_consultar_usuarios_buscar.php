<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';
session_start();

$consulta = $_POST['cadena'];
$consulta = explode(' ',$consulta);

$sql = "SELECT * FROM users WHERE userlevel > 0 AND (";

for($a = 0; $a < count($consulta); $a++){
   if($consulta[$a] != ''){
      if($a != 0)$sql .= 'AND ';
      $sql .= "username LIKE '%".$consulta[$a]."%'";
   }
}

$sql .= 'OR ';

for($a = 0; $a < count($consulta); $a++){
   if($consulta[$a] != ''){
      if($a != 0)$sql .= 'AND ';
      $sql .= "nombre LIKE '%".$consulta[$a]."%'";
   }
}

$sql .= 'OR ';

for($a = 0; $a < count($consulta); $a++){
   if($consulta[$a] != ''){
      if($a != 0)$sql .= 'AND ';
      $sql .= "apellido1 LIKE '%".$consulta[$a]."%'";
   }
}

$sql .= 'OR ';

for($a = 0; $a < count($consulta); $a++){
   if($consulta[$a] != ''){
      if($a != 0)$sql .= 'AND ';
      $sql .= "apellido2 LIKE '%".$consulta[$a]."%'";
   }
}
$sql .= ')';

$rowUsuarios = consultaDB_ALL($sql, $db);
$titulo = 'Buscar usuarios';
$subtitulo = 'Resultados de la búsqueda';


require $baseURL . 'code/accion_consultar_usuarios_generartabla.php';