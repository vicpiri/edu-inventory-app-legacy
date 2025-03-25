<?php
    require '../../../code/config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';
    session_start();
    $usuario = $_SESSION['user'];
    
    $sql = 'SELECT * FROM salidas WHERE devuelto = "f" AND usuario LIKE "' . $usuario . '"';
    $rowsArticulos = consultaDB_ALL($sql, $db);
    $data = [];
    foreach ((array)$rowsArticulos as $art){
        $sql = 'SELECT * FROM articulos WHERE id_articulo = ' . $art['articulo'];
        $rowArticulo = consultaDB($sql, $db);
        
        $sql = 'SELECT * FROM users WHERE username LIKE "' . $art['usuario'] . '"';
        $rowUsuario = consultaDB($sql, $db);
        
        $prestamo = [$rowUsuario['nombre'] . ' ' . $rowUsuario['apellido1'] . ' ' . $rowUsuario['apellido2'],
        format_codigobarras($art['articulo']), 
            $rowArticulo['descripcion'], $rowArticulo['marca'], $rowArticulo['modelo'], date("d-m-Y H:i:s", strtotime($art['fecha']))];
        
        array_push($data, $prestamo);
    }

$header = ['Usuario', 'Código', 'Descripción', 'Marca', 'Modelo', '<div class="text-center">Fecha Préstamo</div>'];
     
?>

<div id="custom-content" class="modal-block modal-block-lg">
    <?php
    
    $contenido = genera_tabla($header, $data, '');
    $tipo = '';
    $icono = '';
    echo genera_panel('Artículos debidos por mi', '', '', $contenido, '', $tipo, $icono)
    ?>
</div>




