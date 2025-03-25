<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

$consulta = $_POST['cadena'];
$consulta = explode(' ',$consulta);

$sql = "SELECT * FROM articulos WHERE ";

for($a = 0; $a < count($consulta); $a++){
   if($consulta[$a] != ''){
      if($a != 0)$sql .= 'AND ';
      $sql .= "descripcion LIKE '%".$consulta[$a]."%'";
   }
}

$sql .= 'OR ';

for($a = 0; $a < count($consulta); $a++){
   if($consulta[$a] != ''){
      if($a != 0)$sql .= 'AND ';
      $sql .= "marca LIKE '%".$consulta[$a]."%'";
   }
}

$sql .= 'OR ';

for($a = 0; $a < count($consulta); $a++){
   if($consulta[$a] != ''){
      if($a != 0)$sql .= 'AND ';
      $sql .= "modelo LIKE '%".$consulta[$a]."%'";
   }
}

$rowArticulos = consultaDB_ALL($sql, $db);

$header = ['<div class="text-center">Código</div>', 'Descripción', 'Marca', 'Modelo', '<div class="text-center">Ubicación</div>'];

$contenido = [];

foreach ((array)$rowArticulos as $key => $articulo) {
    $sql = "SELECT * FROM armarios WHERE id_armario = " . $articulo['ubicacion'];
    $rowArmario = consultaDB($sql, $db);
    
    $contenido[$key] = ['<div class="text-center"><a class="simple-ajax-modal" '
        . 'href="code/accion_consultar_articulos_articulo.php?articulo=' . 
        $articulo['id_articulo'] . '">' . format_codigobarras($articulo['id_articulo']) . '</a></div>', 
        $articulo['descripcion'], 
        $articulo['marca'], $articulo['modelo'], '<div class="text-center"><a class="simple-ajax-modal" '
        . 'href="code/accion_consultar_ubicacion.php?armario=' . 
        $rowArmario['armario'] . '">' . $rowArmario['armario'] . '</a></div>'];
}
$titulo = 'Buscar artículos';
$subtitulo = 'Resultados de la búsqueda';
$datos = genera_tabla($header, $contenido, 0);

echo genera_panel($titulo, $subtitulo, '', $datos, '', 'primario', '');

echo '<script src="java/modals.js" type="text/javascript"></script>';