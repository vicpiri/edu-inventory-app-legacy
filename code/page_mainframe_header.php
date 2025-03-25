<?php
// Antes de instanciar esta porción de código se debe establecer el valor de:
// $nombreAplicacion (desde config.php) y $nombreSeccion
//echo $baseURL;
require_once $baseURL . 'code/main_functions.php';
?>
<header class="page-header">
    <h2><?php echo $nombreAplicacion; ?></h2>

    <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                    <li>
                            <a href="index.php">
                                    <i class="fa fa-home"></i>
                            </a>
                    </li>
                    <?php
                    $rowsAccionBread = $rowsAccion;
                    $breadcrumbs = [];
                    $raiz = false;
                    $rowsAccionBread['nombre'] =  $rowsAccionBread['nombre'] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                    while (!$raiz){
                        if ($rowsAccionBread['parent'] > 0){
                            array_unshift($breadcrumbs, '<li><span>' . $rowsAccionBread['nombre'] . '</span></li>');
                            $sql = 'SELECT * FROM acciones WHERE id = ' . intval($rowsAccionBread['parent']);
                            
                            $rowsAccionBread = consultaDB($sql, $db);
                            
                        }else{
                            array_unshift($breadcrumbs, '<li><span>' . $rowsAccionBread['nombre'] . '</span></li>');
                            $raiz = true;
                        }
                    }
                    
                    foreach ((array)$breadcrumbs as $nombre){
                        echo $nombre;
                    }
                    
                    ?>
                    
                    
                    
            </ol>
    </div>
</header>
