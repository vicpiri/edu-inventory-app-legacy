<?php
/*
 * Generamos la el contenido del panel de módulo
 */
$diractual = getcwd();
$diractual = explode('/', $diractual);
$diractual = array_pop($diractual);

if (file_exists('info.php')){
    chdir('..');
}

$modulos = listar_directorios_ruta('../modules/');
foreach ((array)$modulos as $clave => $dato){
    $instalado = modulecheck($dato, '..');
    $nombre = '';
    $version = '';
    $descripcion = '';
    
    //Comprobamos el archivo de info
    $comprobado = false;
    if (file_exists('../modules/' . $dato . '/info.php')){
        include '../modules/' . $dato . '/info.php';
        $nombre = $nombre_modulo;
        $version = $version_modulo;
        $descripcion = $descripcion_modulo;
        $comprobado = true;
    }else{
        $comprobado = false;
        $nombre = $dato;
        $instalacion = '<div class="text-center"><span class="label label-danger">Error</span></div>';
    }
    
    //Comprobamos si está instalado
    if (file_exists('../modules/' . $dato . '/check.php')){
        if ($instalado){
            $instalacion = '<div class="text-center"><span class="label label-success">Instalado</span></div>';
        }else{
            $instalacion = '<div class="text-center"><span class="label label-warning">No Instalado</span></div>';
        }
    }else{
        $instalacion = '<div class="text-center"><span class="label label-danger">Error</span></div>';
        $comprobado = false;
    }
    $acciones_disponibles = '';
    $accion_instalar = '<i id="install' . $dato . '" class="fa fa-toggle-off"></i>';
    $accion_instalar .= "   <script>
                                $('#install$dato').click(function(){
                                    $('#subframe').load('modules/$dato/install.php',
                                    {paquete:'$dato'});
                                });
                            </script>";
    $accion_desinstalar = '<i class="fa fa-toggle-on"></i>';
    $accion_eliminar = '<i id="delete' . $dato . '" class="fa fa-trash-o"></i>';
    $accion_eliminar .= "   <script>
                                $('#delete$dato').click(function(){
                                    $('#subframe').load('code/delete_module.php',
                                    {paquete:'$dato'});
                                });
                            </script>";
    if ($comprobado){
        if ($instalado){
            $acciones_disponibles = $accion_desinstalar;
        }else{
            $acciones_disponibles = $accion_instalar . $accion_eliminar;
        }
    }else{
        $acciones_disponibles = $accion_eliminar;
    }
    $modulos[$clave] = [$nombre,
        '<div class="text-center">' . $version . '</div>',
        $descripcion,
        $instalacion,
        '<div class = "actions text-center">'
        . $acciones_disponibles
        . '</div>'];
}

$cabecera = ['Nombre Módulo', 'Versión', 'Descripción', 'Instalación', 'Acciones'];


//Generamos la salida de la página

echo genera_panel('Módulos disponibles', NULL, NULL, genera_tabla ($cabecera, $modulos, 'detalles'), NULL, NULL, NULL);
