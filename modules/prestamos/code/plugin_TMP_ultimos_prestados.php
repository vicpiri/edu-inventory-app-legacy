<?php
    require '../../../code/config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $usuario = $_SESSION['user'];
    
    $sql = 'SELECT * FROM salidas WHERE usuario_presta LIKE "' . $usuario . '" ORDER BY fecha DESC LIMIT 7';
    $rowsSalidas = consultaDB_ALL($sql, $db);
    
 
?>



<div class="col-lg-6 col-md-12">
        <section class="panel">
                <header class="panel-heading panel-heading-transparent">
                        <div class="panel-actions">
                                
                        </div>

                        <h2 class="panel-title">Últimos Préstamos Realizados</h2>
                </header>
                <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped mb-none">
                                        <thead>
                                                <tr>
                                                        <th>Art.</th>
                                                        <th>Usuario</th>
                                                        <th>Status</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                
    <?php
    foreach ((array)$rowsSalidas as $salida) {
        echo '<tr>';
        echo '<td><a class="simple-ajax-modal" href="code/accion_consultar_articulos_articulo.php?articulo=' 
        . format_codigobarras($salida['articulo']) .'">' 
        . format_codigobarras($salida['articulo']) .'</a></td>';
        $sql = 'SELECT * FROM users WHERE username LIKE "' . $salida['usuario'] . '"';
        $rowUsuario = consultaDB($sql, $db);
        echo '<td>' . $rowUsuario['nombre'] . ' ' . $rowUsuario['apellido1'] . ' ' . $rowUsuario['apellido2'] . '</td>';
        if($salida['devuelto'] == 't'){
            echo '<td><span class="label label-success">Devuelto</span></td>';
        }else{
            echo '<td><span class="label label-danger">Prestado</span></td>';
        }
        
        echo '</tr>';
       
    }
    ?>
                                        </tbody>
                                </table>
                        </div>
                </div>
        </section>
</div>

<script src="java/modals.js"></script>

