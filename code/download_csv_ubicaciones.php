<?php

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

if (isset($_GET['area'])){
$area = $_GET['area'];
$sql = "SELECT * FROM areas WHERE id_area = $area";

$row = consultaDB($sql, $db);

$area_nombre = $row['nombre'];

$output = fopen("php://output", 'w') or die("Can't open php://output");
header("Content-Type:application/csv");
header("Content-Disposition:attachment;filename=ubicaciones_$area_nombre.csv");

$sql = "SELECT * FROM armarios WHERE area = $area";

$rows = consultaDB_ALL($sql, $db);

fputcsv($output, array('area', 'id', 'nombre'));
  foreach($rows as $row) {
    $item = [];
    array_push($item, $area_nombre);  
    array_push($item, $row['armario']);
    array_push($item, $row['descripcion']);

  fputcsv($output, $item);
  } 
fclose($output) or die("Can't close php://output");
}


