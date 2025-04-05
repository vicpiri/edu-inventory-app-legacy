<?php
    require '../../../code/config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $usuario = $_SESSION['user'];
    
    $sql = 'SELECT * FROM salidas WHERE devuelto = "f" AND usuario LIKE"' . $usuario . '"';
    $count = consultaDB_ALL($sql, $db);
 
?>

<li id="WIDdebidos">
        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-file-text"></i>
                <span class="badge"><?php echo sizeof($count) ?></span>
        </a>

        <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                        
                        Artículos a devolver
                </div>

                <div class="content">
                        <ul>
                            <?php
                            //print_r($count);
                            for ($i = 0; ($i < sizeof($count)) && ($i <= 6); $i++){
                                $sql = "SELECT * FROM articulos WHERE id_articulo = " . $count[$i]['articulo'];
                                $articulo = consultaDB($sql, $db);
                            ?>
                                <li>
                                        <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="images/<?php echo buscaFotoArticulo($articulo['id_articulo'], $db, $baseURL . 'images/'); ?>" class="img-circle" width="30px">
                                                </figure>
                                            <span class="title"><?php echo format_codigobarras($count[$i]['articulo']); ?></span>
                                                <span class="message"><?php echo substr($articulo['descripcion'], 0, 50); ?></span>
                                        </a>
                                </li>
                            <?php   
                            }
                            ?>
                                
                        </ul>

                        <hr>

                        <div class="text-right">
                                <?php
                                    $lburl = $baseURLClient . "/modules/prestamos/code/plugin_TMP_WIDG_prestamos_debidos_vertodos.php";
                                    $lbdata = 'usuario=' . $_SESSION['user'];
                                ?>
                                <a class="text-muted view-more" href="#" 
                                   onclick="enviaLightbox('<?php echo $lbdata;?>', '<?php echo $lburl;?>')">VER TODOS</a>
                        </div>
                </div>
        </div>
</li>





