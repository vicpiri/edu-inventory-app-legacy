<?php
require_once '../../../code/config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$consulta = $_POST['cadena'];
$consulta = explode(' ',$consulta);

$sql = "SELECT * FROM users INNER JOIN matriculas ON users.username = matriculas.usuario WHERE userlevel > 0 AND (";

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
$titulo = 'Buscar Usuarios en Grupos';
$subtitulo = 'Resultados de la búsqueda';

$header = ['Usuario', '<div class="text-center">Abreviatura Grupo</div>', 'Grupo', 'Tutor'];

$contenido = [];

foreach ($rowUsuarios as $key => $usuario) {
    $sql = 'SELECT * FROM grupos WHERE abreviatura = "' . $usuario['grupo'] . '"';
    $rowGrupo = consultaDB($sql, $db);
    
    $contenido[$key] = [$usuario['apellido1'] . ' ' .
        $usuario['apellido2']. ', ' .
        $usuario['nombre'],
        '<div class="text-center">' . $usuario['grupo'] . '</div>',
        $rowGrupo['descripcion'],
        $rowGrupo['tutor']];
}

$datos = genera_tabla($header, $contenido, 0);

echo genera_panel($titulo, $subtitulo, '', $datos, '', 'primario', '');

echo '<script src="java/modals.js" type="text/javascript"></script>';


