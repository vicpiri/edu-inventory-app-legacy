<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';

//Consulta por tipo
$contenido = file_get_contents($baseURL . 'code/accion_consultar_usuarios_TMPformTipo.php');
echo '<div class="row" id="consultarUsuarios">';
echo '<div class="col-md-6">';
echo genera_panel('Consulta usuarios por Tipo', '', '', $contenido);
echo '</div>';

// Buscar
$contenido = file_get_contents($baseURL . 'code/accion_consultar_usuarios_TMPformBuscar.php');
echo '<div class="col-md-6">';
echo genera_panel('Buscar Usuario', '', '', $contenido);
echo '</div>';
echo '</div>';
//echo '<script src="assets/javascripts/ui-elements/examples.modals.js"></script>';
