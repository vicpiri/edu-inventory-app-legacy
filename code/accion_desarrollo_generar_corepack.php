<section class="panel-primary">
    <header class="panel-heading">
            <div class="panel-actions">
                    
            </div>

            <h2 class="panel-title">Generar CORE-PACK</h2>
    </header>
    <form id="form3" class="form-horizontal form-bordered" method="get">
        <div class="panel-body" id="loadingSpinnerPanel" data-loading-overlay >
             <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess">Acciones a incluir en el paquete</label>
                    <div class="col-md-6">
<?php
$sql = 'SELECT * FROM acciones WHERE paquete="core"';

$rowsAcciones = consultaDB_ALL($sql, $db);

foreach ((array)$rowsAcciones as $accion) {
    ?>
    <div class="checkbox">
            <label>
                    <input type="checkbox" value="<?php echo $accion['accionkey']?>">
                    <?php 
                        echo '<span class="text-danger">' . $accion['nombre'] . '</span>';
                        echo ' - ';
                        echo '<span class="text-dark">' . $accion['descripcion'] . '</span>';
                        echo ' V' . $accion['version'];
                        echo '<span class="text-success"> ' . $accion['accionkey'] . '</span>';
                    ?>
            </label>
        
    </div>
    <?php
    
}

?>
                            
                        </div>
            </div>
            <div class="form-group">
                    <label class="col-md-3 control-label" for="inputDefault">Nombre del paquete</label>
                    <div class="col-md-6">
                            <input type="text" class="form-control" id="inputDefault">
                    </div>
            </div>
        </div>
                     
    <div class="panel-footer text-right">
        <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-save"></i> Descargar</button>
                </div>
        </div>
            
    </div>
</form>
</section>

