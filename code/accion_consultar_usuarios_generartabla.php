<?php
$header = ['Nombre', 'Apellido 1', 'Apellido 2'];

if ($_SESSION['userlevel'] < 2){ //Añadimos la columna de opciones si tenemos los permisos adecuados
    array_push($header, '<div class="text-center">Opciones</div>');
}

$contenido = [];

foreach ((array)$rowUsuarios as $key => $usuario) {
    
    $contenido[$key] = [$usuario['nombre'], 
        $usuario['apellido1'], 
        $usuario['apellido2']];
    $opciones = '<a class="simple-ajax-modal" href="' . $baseURLClient . 'code/accion_consultar_usuarios_usuario.php?usuario=' . $usuario['username'] .'">'
            . '<i class="fa fa-info-circle text-primary"></i></a>';

    if ($_SESSION['userlevel'] < $usuario['userlevel']){
        $opciones .= '<a href="#"><i class="fa fa-edit" id="usuario' . $key . '"></i></a>';
        $opciones .= '<script>$("#usuario' . $key .'").click('. 'function(){';
        $opciones .= '$("#subframe").load("' . $baseURLClient . 'code/accion_administracion_editar_usuario.php?username=' . $usuario['username'] . '");';
        $opciones .= '});';
        $opciones .= '</script>';
        //$opciones .= '<a href="#"><i class="fa fa-trash-o text-danger"></i></a>';
    }
    
    array_push($contenido[$key], '<div class = "actions text-center">'
        . $opciones
        . '</div>');
}

$datos = genera_tabla($header, $contenido, 0);

echo genera_panel($titulo, $subtitulo, '', $datos, '', 'primario', '');

echo '<script src="java/modals.js" type="text/javascript"></script>';
