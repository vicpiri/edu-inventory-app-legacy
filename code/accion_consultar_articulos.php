<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';

// Consulta por código
$contenido = file_get_contents($baseURL . 'code/accion_consultar_articulos_TMPformCodigo.php');
echo '<div id="consultarArticulos">';            
echo '<div class="row">';
echo '<div class="col-md-6">';
echo genera_panel('Consulta artículo por código', '', '', $contenido);
echo '</div>';

//Consulta por tipo
$contenido = file_get_contents($baseURL . 'code/accion_consultar_articulos_TMPformTipo.php');
echo '<div class="col-md-6">';
echo genera_panel('Consulta artículo por tipo', '', '', $contenido);
echo '</div>';
echo '</div>';

//Consulta por ubicación
$contenido = file_get_contents($baseURL . 'code/accion_consultar_articulos_TMPformUbicacion.php');
echo '<div class="row">';
echo '<div class="col-md-6">';
echo genera_panel('Consulta artículo por ubicación', '', '', $contenido);
echo '</div>';


// Buscar
$contenido = file_get_contents($baseURL . 'code/accion_consultar_articulos_TMPformBuscar.php');
echo '<div class="col-md-6">';
echo genera_panel('Buscar artículo', '', '', $contenido);
echo '</div>';
echo '</div>';
echo '</div>';
//echo '<script src="assets/javascripts/ui-elements/examples.modals.js"></script>';
