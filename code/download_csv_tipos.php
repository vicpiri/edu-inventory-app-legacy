<?php

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$output = fopen("php://output", 'w') or die("Can't open php://output");
header("Content-Type:application/csv");
header("Content-Disposition:attachment;filename=tipos_articulo.csv");

$sql = "SELECT * FROM tipos";

$rows = consultaDB_ALL($sql, $db);

fputcsv($output, array('id','nombre'));
  foreach($rows as $row) {
    $item = [];
      
    array_push($item, $row['id']);
    array_push($item, $row['nombre']);

  fputcsv($output, $item);
  } 
fclose($output) or die("Can't close php://output");


