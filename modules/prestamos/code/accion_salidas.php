<?php
//Preparamos el formulario y lo generamos

$contenido = '<div class="form-group">';
$contenido .= '     <label class="col-md-3 control-label">Código de Usuario</label>';
$contenido .= '     <div class="col-md-6">';
$contenido .= '     <input name="user" type="password" class="form-control autofocus" placeholder="" id="inputUser" autofocus>';
$contenido .= '     </div>';
$contenido .= '     </div><script>$(".autofocus").trigger("focus")</script>';

$footer = '<button class="btn btn-primary">Aceptar</button>';

echo '<form class="form-horizontal form-bordered" action="#" id="form1">';
echo genera_panel('Préstamos', 'Introduce el código de usuario que retira el material.', NULL, $contenido, $footer, 'primario');
echo '</form>';

echo "<script> enviaFormulario('#form1', 'modules/prestamos/code/accion_salidas2.php', '#subframe'); </script>";


