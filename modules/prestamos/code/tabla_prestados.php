<?php

$sql = 'SELECT * FROM salidas WHERE usuario LIKE "' . $rowsUser['username'] .'" AND devuelto = "f" ORDER BY fecha DESC';
$rowsArticulos = consultaDB_ALL($sql, $db);
$articulos = [];
foreach ((array)$rowsArticulos as $art){
    $sql = 'SELECT * FROM articulos WHERE id_articulo = ' . $art['articulo'];
    $rowArticulo = consultaDB($sql, $db);
    
    if ($rowArticulo ['fungible']){ //Si el artículo es fungible lo añadimos a la lista de fungibles
        if (strlen($rowArticulo['descripcion']) > 37){
            $descripcion = substr($rowArticulo['descripcion'], 0, 37) . '...';
        }else{
            $descripcion = $rowArticulo['descripcion'];
        }
        //Buscamos si ya existe en la lista de fungibles
        $encontrado = false;
        foreach ((array)$fungibles as $key => $fungible){
            if (intval($fungible[1]) == intval($art['articulo'])){
                $fungibles[$key][0] ++;

                $encontrado = true;
            }
        }
        if (!$encontrado){
            $fungibles[] = [1, 
                format_codigobarras($art['articulo']),
            $descripcion, $rowArticulo['marca'], $rowArticulo['modelo'],
                '<div class="text-center">' . date("d-m-Y H:i:s",strtotime($art['fecha'])) . '</div>'];
        }
    }else{ //Si no es fungible, lo añadimos al la lista normal de préstamos
        if (strlen($rowArticulo['descripcion']) > 37){
            $descripcion = substr($rowArticulo['descripcion'], 0, 37) . '...';
        }else{
            $descripcion = $rowArticulo['descripcion'];
        }
        $articulos[] = ['','<div class="text-center"><a class="simple-ajax-modal" '
            . 'href="code/accion_consultar_articulos_articulo.php?articulo=' . 
            $art['articulo'] . '">' . format_codigobarras($art['articulo']) . '</a></div>',
        $descripcion, $rowArticulo['marca'], $rowArticulo['modelo'],
            '<div class="text-center">' . date("d-m-Y H:i:s",strtotime($art['fecha'])) . '</div>'];
    }
}

foreach ((array)$fungibles as $key => $fungible){

    $fungibles[$key][0] = '<div class="text-center"><span class="label label-primary">' . $fungibles[$key][0] . '</span></div>';
    $fungibles[$key][1] = '<div class="text-center"><a class="simple-ajax-modal" '
            . 'href="code/accion_consultar_articulos_articulo.php?articulo=' . 
            $fungibles[$key][1] . '">'  . $fungibles[$key][1] . '</a></div>';

}

if (isset($fungibles)){
    $articulos = array_merge($fungibles, $articulos);
}
$header = ['','<div class="text-center">Código</div>', 'Descripción', 'Marca', 'Modelo', '<div class="text-center">Fecha Préstamo</div>'];

