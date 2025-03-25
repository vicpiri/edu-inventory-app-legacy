<?php

require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

if (isset($_POST['centro'])){
    $centro = $_POST['centro'];
}else{
    $centro = -1;
}

if (isset($_POST['departamento'])){
    $departamento = $_POST['departamento'];
}else{
    $departamento = -1;
}

if (isset($_POST['area'])){
    $area = $_POST['area'];
}else{
    $area = -1;
}

if (isset($_POST['armario'])){
    $armario = $_POST['armario'];
}else{
    $armario = -1;
}

if($armario > 0){
    $sql = "SELECT *, articulos.descripcion AS articulo_descripcion FROM articulos WHERE ubicacion = $armario";
} elseif ($area > 0) {
    $sql = "SELECT *, articulos.descripcion AS articulo_descripcion FROM articulos JOIN armarios"
            . " ON articulos.ubicacion = armarios.id_armario WHERE armarios.area = $area";
} elseif ($departamento > 0) {
    $sql = "SELECT *, articulos.descripcion AS articulo_descripcion FROM articulos JOIN armarios"
            . " ON articulos.ubicacion = armarios.id_armario JOIN areas ON "
            . "areas.id_area = armarios.area WHERE areas.departamento = $departamento";
} elseif ($centro > 0) {
    $sql = "SELECT *, articulos.descripcion AS articulo_descripcion FROM articulos JOIN armarios"
            . " ON articulos.ubicacion = armarios.id_armario JOIN areas ON "
            . "areas.id_area = armarios.area JOIN departamentos ON areas.departamento = departamentos.id_departamento "
            . "WHERE departamentos.centro = $centro";   
} else {
    $sql = "SELECT *, articulos.descripcion AS articulo_descripcion FROM articulos";
}

$rowArticulos = consultaDB_ALL($sql, $db);

//print_r($rowArticulos);

$header = ['<div class="text-center">Código</div>', 'Descripción', 'Marca', 'Modelo', '<div class="text-center">Ubicación</div>'];

$contenido = [];

foreach ((array)$rowArticulos as $key => $articulo) {
    $sql = "SELECT * FROM armarios WHERE id_armario = " . $articulo['ubicacion'];
    $rowArmario = consultaDB($sql, $db);
    
    $contenido[$key] = ['<div class="text-center"><a class="simple-ajax-modal" '
        . 'href="code/accion_consultar_articulos_articulo.php?articulo=' . 
        $articulo['id_articulo'] . '">' . format_codigobarras($articulo['id_articulo']) . '</a></div>', 
        $articulo['articulo_descripcion'], 
        $articulo['marca'], $articulo['modelo'], '<div class="text-center"><a class="simple-ajax-modal" '
        . 'href="code/accion_consultar_ubicacion.php?armario=' . 
        $rowArmario['armario'] . '">' . $rowArmario['armario'] . '</a></div>'];
}
$titulo = 'Consulta de artículos por ubicación';

// Now we compose the subtitle
if($centro == '-'){
    $subtitulo = '-';
}elseif ($centro == 0) {
    $subtitulo = 'TODOS';
}else{
    $sql = "SELECT * FROM centros WHERE id = $centro";
    $rowCentro = consultaDB($sql, $db);
    $subtitulo = $rowCentro['nombre'];
}

if($departamento == '-'){
    $subtitulo = $subtitulo . ' / ' . '-';
}elseif ($departamento == 0) {
    $subtitulo = $subtitulo . ' / ' . 'TODOS';
}else{
    $sql = "SELECT * FROM departamentos WHERE id_departamento = $departamento";
    $rowDepartamento = consultaDB($sql, $db);
    $subtitulo = $rowDepartamento['descripcion'];
}

if($area == '-'){
    $subtitulo = $subtitulo . ' / ' . '-';
}elseif ($area == 0) {
    $subtitulo = $subtitulo . ' / ' . 'TODOS';
}else{
    $sql = "SELECT * FROM areas WHERE id_area = $area";
    $rowArea = consultaDB($sql, $db);
    $subtitulo = $subtitulo . ' / ' . $rowArea['nombre'];
}

if($armario == '-'){
    $subtitulo = $subtitulo . ' / ' . '-';
}elseif ($armario == 0) {
    $subtitulo = $subtitulo . ' / ' . 'TODOS';
}else{
    $sql = "SELECT * FROM armarios WHERE id_armario = $armario";
    $rowArmario = consultaDB($sql, $db);
    $subtitulo = $subtitulo . ' / ' . $rowArmario['armario'] . ' (' .$rowArmario['descripcion'] . ')';
}
$datos = genera_tabla($header, $contenido, 0);

echo genera_panel($titulo, $subtitulo, '', $datos, '', 'primario', '');

echo '<script src="java/modals.js" type="text/javascript"></script>';