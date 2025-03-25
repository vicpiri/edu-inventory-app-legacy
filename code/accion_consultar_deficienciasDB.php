<section class="panel-primary">
    <header class="panel-heading">
            <div class="panel-actions">
                    
            </div>

            <h2 class="panel-title">Consulta de deficiencias en la base de datos</h2>
    </header>
    <form id="form3" class="form-horizontal form-bordered" method="get">
        <div class="panel-body" id="loadingSpinnerPanel" data-loading-overlay >
             
<?php
$sql = 'SELECT id_articulo, COUNT(*) Total FROM articulos GROUP BY id_articulo HAVING COUNT(*) > 1';

$rowsRepetidos = consultaDB_ALL($sql, $db);

//print_r($rowsRepetidos);
echo 'ARTÍCULOS DUPLICADOS: <br/><br/>';
foreach ((array)$rowsRepetidos as $repetido) {
    $sql = 'SELECT * FROM articulos WHERE id_articulo="' . $repetido['id_articulo'] . '"';
    $rowsArticulo = consultaDB_ALL($sql, $db);
    foreach ((array)$rowsArticulo as $articulo) {
        echo $articulo['id_articulo'] . ' - ' . $articulo['descripcion'] . '</br>';
    }
}

?>
            
        </div>
                     
    <div class="panel-footer text-right">
        <div class="row">
                
        </div>
            
    </div>
</form>
</section>

