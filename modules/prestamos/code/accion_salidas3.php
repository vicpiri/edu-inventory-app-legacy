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
            $fecha=date("Y-m-d H:i:s",time());
            //Si está prestado comprobamos si es fungible
            if ($rowsArticulo['fungible']){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $user = $_SESSION["user"];
                $sql="INSERT INTO salidas (usuario, articulo, fecha, fecha_devolucion, usuario_presta) VALUES('$usuario_prestamo', '$articulo', '$fecha', '$fecha', '$user')";
                consultaDB($sql, $db);
            }else if ($usuario_prestamo === $rowsSalidas['usuario']){
                //Si no es fungible comprobamos si está en la lista del usuario actual
                echo "<script> notification('warning','Repetido', 'Este artículo ya está en la lista."
                . "<br/>Se ha ignorado la anotación', 'fa fa-exclamation') </script>";
            }else{
                //Si está prestado, anotamos la devolución y generamos una nueva salida. Después notificamos la situación.
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                //$fecha=date("Y-m-d",time());
                $sql="UPDATE salidas SET usuario_devuelve='" . $_SESSION['user'] . "', devuelto='t', fecha_devolucion='".$fecha."' WHERE id_salida='".$rowsSalidas["id_salida"]."'";
                consultaDB($sql, $db);
                $user = $_SESSION["user"];
                $sql="INSERT INTO salidas (usuario, articulo, fecha, fecha_devolucion, usuario_presta) VALUES('$usuario_prestamo', '$articulo', '$fecha', '$fecha', '$user')";
                consultaDB($sql, $db);
                
                echo "<script> notification('warning', 'Este artículo estaba prestado', 'El artículo " . 
                        format_codigobarras($articulo) . " acaba de cambiar de préstamo', 'fa fa-exclamation') </script>";
            }
        }else{
            $fecha=date("Y-m-d H:i:s",time());
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $user = $_SESSION["user"];
            $sql="INSERT INTO salidas (usuario, articulo, fecha, fecha_devolucion, usuario_presta) VALUES('$usuario_prestamo', '$articulo', '$fecha', '$fecha', '$user')";
            consultaDB($sql, $db);
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
        ' ' . $rowsUser['apellido2'], $foto, 'Préstamos', count($rowsArticulos), $contenido . '</br>' . genera_tabla($header, $articulos));
/*echo genera_panel($rowsUser['nombre'] . ' ' . $rowsUser['apellido1'] . ' ' . $rowsUser['apellido2'],
        'Préstamos', NULL, $contenido . '</br>' . genera_tabla($header, $articulos), NULL, 'primario');
 * 
 */
echo '</form>';

echo "<script> enviaFormulario('#form1', 'modules/prestamos/code/accion_salidas2.php', '#subframe'); </script>";
echo '<script src="java/modals.js" type="text/javascript"></script>';
echo "<script>
        ajaxUpdate('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_WIDG_prestamos_debidos.php', '.notifications', '#WIDdebidos');
</script>";
