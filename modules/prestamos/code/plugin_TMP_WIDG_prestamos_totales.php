<?php

    require '../../../code/config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';
    if (!isset($_SESSION)){
        session_start();
    }

        $sql = 'SELECT * FROM salidas WHERE devuelto = "f"';
        $results = consultaDB_ALL($sql, $db);
        
        $sql ='SELECT COUNT(DISTINCT usuario) FROM salidas WHERE devuelto = "f"';
        $count = consultaDB($sql, $db);
 
?>
<div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-tertiary">
                            <div class="panel-body">
                                    <div class="widget-summary">
                                            <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-tertiary">
                                                            
                                                            <i class="fa fa-barcode"></i>
                                                    </div>
                                            </div>
                                            <div class="widget-summary-col">
                                                    <div class="summary">
                                                            <h4 class="title">Préstamos totales</h4>
                                                            <div class="info">
                                                                <strong class="amount"><?php echo count($results); ?></strong>
                                                                <span class="text-primary">(<?php echo $count[0]; ?> usuarios)</span>
                                                            </div>
                                                    </div>
                                                    <div class="summary-footer">
                                                            <?php
                                                                $lburl = $baseURLClient . "/modules/prestamos/code/plugin_TMP_WIDG_prestamos_totales_vertodos.php";
                                                                $lbdata = 'usuario=' . $_SESSION['user'];
                                                            ?>
                                                            <a class="text-muted text-uppercase" href="#" 
                                                               onclick="enviaLightbox('<?php echo $lbdata;?>', '<?php echo $lburl;?>')">(ver todos)</a>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </section>
            </div>
