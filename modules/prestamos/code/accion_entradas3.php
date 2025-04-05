<?php
// Si existe mostramos el nuevo formulario

$contenido = '<div class="form-group">';
//$contenido .= '<div class="col-md-12">Introduce el código del artículo que se va a prestar.</div>';
$contenido .= '     <label class="col-md-3 control-label">Código de Artículo</label>';
$contenido .= '     <div class="col-md-6">';
$contenido .= '         <input type="text" class="form-control autofocus" placeholder="" name="inputArticulo">';
$contenido .= '         <input name="user" type="hidden" value="' . $rowsUser['username'] . '" />';
$contenido .= '     </div>';
$contenido .= '     <div class="col-md-3">';
$contenido .= '         <button class="btn btn-primary">Anotar</button>';
$contenido .= '     </div>';
$contenido .= '</div><script>$(".autofocus").trigger("focus")</script>';

$articulo = (filter_input(INPUT_POST, 'inputArticulo'));


if ($articulo){ //Si se ha enviado información de un artículo, realizamos las comprobaciones
    //Comprobamos si el artículo introducido existe en la tabla artículos
    $sql = 'SELECT * FROM articulos WHERE id_articulo = ' . $articulo;
    $rowsArticulo = consultaDB($sql, $db);
    if (!$rowsArticulo){
        echo "<script> notification('error', 'Error de artículo', 'El artículo " .
                format_codigobarras($articulo) . " no existe', 'fa fa-exclamation') </script>";
    }else{
        //Comprobamos si el artículo ya está prestado
        $sql = 'SELECT * FROM salidas WHERE articulo = ' . $articulo . ' AND devuelto = "f"';
        $rowsSalidas = consultaDB($sql, $db);
        
        if ($rowsSalidas){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $fecha=date("Y-m-d H:i:s",time());
            $sql="UPDATE salidas SET usuario_devuelve='" . $_SESSION['user'] . "', devuelto='t', fecha_devolucion='".$fecha."' WHERE id_salida='".$rowsSalidas["id_salida"]."'";
            consultaDB($sql, $db);
        }else{
            echo "<script> notification('warning', 'Artículo NO Prestado', 'El artículo " . 
                        format_codigobarras($articulo) . " no consta como prestado.', 'fa fa-exclamation') </script>";
        }
    }
}
////
//Mostramos tabla de artículos prestados
///////

require 'tabla_prestados.php';
if (file_exists($baseURL . 'userimages/' . $rowsUser["foto"])){
    $foto = $rowsUser["foto"];
}else{
    $foto = 'no_imagen.jpg';
}

echo '<form class="form-horizontal form-bordered" action="#" id="form1">';
echo genera_panel_prestamos($rowsUser['nombre'] . ' ' . $rowsUser['apellido1'] .
        ' ' . $rowsUser['apellido2'], $foto, 'Devoluciones', count($rowsArticulos), $contenido . '</br>' . genera_tabla($header, $articulos));

echo '</form>';

echo "<script> enviaFormulario('#form1', 'modules/prestamos/code/accion_entradas2.php', '#subframe'); </script>";

echo '<script src="java/modals.js" type="text/javascript"></script>';
echo "<script>
        ajaxUpdate('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_WIDG_prestamos_debidos.php', '.notifications', '#WIDdebidos');
</script>";
