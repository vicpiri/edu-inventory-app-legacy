<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

//Crear centro
$contenido = file_get_contents($baseURL . 'code/accion_administracion_editar_ubicacion_TMPformCentro.php');
            
echo '<div class="row">';
echo '<div class="col-md-6">';
echo genera_panel('Editar Centro', '', '', $contenido);
echo '</div>';


//Crear departamento
$contenido = file_get_contents($baseURL . 'code/accion_administracion_editar_ubicacion_TMPformDepartamento.php');
echo '<div class="col-md-6">';
echo genera_panel('Editar Departamento', '', '', $contenido);
echo '</div>';
echo '</div>';


//Crear Área
$contenido = file_get_contents($baseURL . 'code/accion_administracion_editar_ubicacion_TMPformArea.php');
echo '<div class="row">';
echo '<div class="col-md-6">';
echo genera_panel('Editar Área', '', '', $contenido);
echo '</div>';


//Crear Ubicación
$contenido = file_get_contents($baseURL . 'code/accion_administracion_editar_ubicacion_TMPformUbicacion.php');
echo '<div class="col-md-6">';
echo genera_panel('Editar Ubicación', '', '', $contenido);
echo '</div>';
echo '</div>';

?>

