<section class="panel-primary">
    <header class="panel-heading">
            <div class="panel-actions">
                    
            </div>

            <h2 class="panel-title">Limpiar DB usuarios</h2>
    </header>
    <form id="form3" class="form-horizontal form-bordered" method="get">
        <div class="panel-body" id="loadingSpinnerPanel" data-loading-overlay >
             <div class="form-group">
                    <div class="col-md-6">
<?php
$sql = 'DELETE FROM users WHERE id > 2';



try{
    $st = $db->query($sql);
    if (!$st) {
        echo "Problema con la base de datos DELETE matriculas: ";
        print_r($db->errorInfo());
        $erroresDB ++;
    }else{
        print_r($st);
    }
}catch (PDOException $e) {
    $erroresDB ++;
    echo "Problema con la base de datos DELETE: ";
    print_r($e->getMessage());
}

?>
                            
                        </div>
            </div>

        </div>
                     
    <div class="panel-footer text-right">
        <div class="row">
                
        </div>
            
    </div>
</form>
</section>

