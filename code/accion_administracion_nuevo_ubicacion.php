<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

//Crear centro
$contenido = file_get_contents($baseURL . 'code/accion_administracion_nuevo_ubicacion_TMPformCentro.php');
            
echo '<div class="row">';
echo '<div class="col-md-6">';
echo genera_panel('Crear nuevo Centro', '', '', $contenido);
echo '</div>';


//Crear departamento
$contenido = file_get_contents($baseURL . 'code/accion_administracion_nuevo_ubicacion_TMPformDepartamento.php');
echo '<div class="col-md-6">';
echo genera_panel('Crear nuevo Departamento', '', '', $contenido);
echo '</div>';
echo '</div>';


//Crear Área
$contenido = file_get_contents($baseURL . 'code/accion_administracion_nuevo_ubicacion_TMPformArea.php');
echo '<div class="row">';
echo '<div class="col-md-6">';
echo genera_panel('Crear nueva Área', '', '', $contenido);
echo '</div>';


//Crear Ubicación
$contenido = file_get_contents($baseURL . 'code/accion_administracion_nuevo_ubicacion_TMPformUbicacion.php');
echo '<div class="col-md-6">';
echo genera_panel('Crear nueva Ubicación', '', '', $contenido);
echo '</div>';
echo '</div>';

?>

