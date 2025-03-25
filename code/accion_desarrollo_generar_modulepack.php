<section class="panel-primary">
    <header class="panel-heading">
            <div class="panel-actions">
                    
            </div>

            <h2 class="panel-title">Generar MODULE-PACK</h2>
    </header>
    <form id="form3" class="form-horizontal form-bordered" method="get">
        <div class="panel-body" id="loadingSpinnerPanel" data-loading-overlay >
             <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess">Seleccione el módulo a empaquetar</label>
                    <div class="col-md-6">
<?php
$sql = 'SELECT DISTINCT paquete FROM acciones WHERE NOT paquete="core"';

$rowsAcciones = consultaDB_ALL($sql, $db);

for($i = 0; $i < count($rowsAcciones)-1; $i++) {
    ?>
                        
    <div class="radio">
            <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="<?php echo $rowsAcciones[$i]['paquete']; ?>">
                    <?php 
                        echo '<span class="text-danger">' . $rowsAcciones[$i]['paquete'] . '</span>';
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

