<?php
require_once 'config.php';
require_once 'main_functions.php';
require_once 'version.php';
require_once 'update_server.php';
$modulos = modulesearch();

$url = "$update_server/updates.php?client=$client&version=$version_aplicacion&module=$modulos";

$a = json_decode(file_get_contents($url));
//echo 'A:-- ';
//print_r($a);
//echo '<br/>';

$url2 = "$update_server/new.php?client=$client&version=$version_aplicacion&module=$modulos";

$b = json_decode(file_get_contents($url2));
//echo 'B:-- ';
//print_r($b);

?>
<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Actualizaciones disponibles</h2>
    </header>
    <div class="panel-body" id="disponibles">
        
        <?php
        if (count($a) > 0){
        ?>

        <div class="table-responsive">
            <table class="table mb-none">
                <thead>
                    <tr>
                        <th>Paquete</th>
                        <th>Versión Actual</th>
                        <th>Versión Actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ((array)$a as $ver){
                        if ($ver[0] === 'core'){
                            $nombre_modulo = 'Aplicación principal';
                            $version_modulo = $version_aplicacion;
                            $tipo = 'core';
                        }else{
                            $tipo = 'module';
                            include '../modules/' . $ver[0] . '/info.php';
                        }
                        if ($ver[1] > 0){
                            if ($ver[0] === 'core'){
                                $archivo = "http://apps.moon-brain.com/inventario_support/downloads/core/release/$ver[1].zip";
                            }else{
                                $archivo = "http://apps.moon-brain.com/inventario_support/downloads/modules/$ver[0]/release/$ver[1].zip";
                            }
                            
                            
                            echo "<tr>";
                            echo "<td>$nombre_modulo</td>";
                            echo "<td>$version_modulo</td>";
                            echo "<td>$ver[1]</td>";
                            echo "<td>"
                            . "<button id='install$ver[0]' class='btn btn-sm btn-primary'>Obtener</button>&nbsp;";
                            //echo "<button class='btn btn-sm btn-warning'>Información</button></td>";
                            echo "</tr>";
                            ?>
                            <script>
                                $('#install<?php echo $ver[0]?>').click(function(){
                                    $('#subframe button').prop( "disabled", true );
                                    $('#install<?php echo $ver[0]?>').html('Descargando...').removeClass('btn-primary').addClass('btn-warning');
                                    $('#subframe').load('code/accion_administracion_consultar_actualizaciones_install.php',
                                    {paquete:'<?php echo $archivo?>', tipopaquete:'<?php echo $tipo?>', nombrepaquete:'<?php echo $ver[0]?>'});
                                });
                            </script>    
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        }else{
            echo 'No hay actualizaciones disponibles';
        }
        ?>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Módulos nuevos disponibles</h2>
    </header>
    <div class="panel-body" id="nuevos">
        <?php
        $count = 0;
        foreach ((array)$b as $ver){
            if (isset($ver[1])){
                if ($ver[1] > 0){
                    $count ++;
                }
            }
        }
        if ($count > 0){
        ?>

        <div class="table-responsive">
            <table class="table mb-none">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ((array)$b as $ver){
                        
                        $tipo = 'module';
                        
                        $c = json_decode(file_get_contents('http://apps.moon-brain.com/inventario_support/downloads/modules/' . $ver[0] . '/info.php'));
                        
                        if ($ver[1] > 0){
                            
                            $archivo = "http://apps.moon-brain.com/inventario_support/downloads/modules/$ver[0]/release/$ver[1].zip";
                            
                            
                            
                            echo "<tr>";
                            echo "<td>$c[0]</td>";
                            echo "<td>$c[1]</td>";
                            echo "<td>"
                            . "<button id='install$ver[0]' class='btn btn-sm btn-primary'>Obtener</button>&nbsp;";
                            //echo "<button class='btn btn-sm btn-warning'>Información</button></td>";
                            echo "</tr>";
                            ?>
                            <script>
                                $('#install<?php echo $ver[0]?>').click(function(){
                                    $('#subframe button').prop( "disabled", true );
                                    $('#install<?php echo $ver[0]?>').html('Descargando...').removeClass('btn-primary').addClass('btn-warning');
                                    $('#subframe').load('code/accion_administracion_consultar_actualizaciones_install.php',
                                    {paquete:'<?php echo $archivo?>', tipopaquete:'<?php echo $tipo?>', nombrepaquete:'<?php echo $ver[0]?>'});
                                });
                            </script>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        }else{
            echo 'No hay más módulos disponibles en este momento';
        }
        ?>
              
    </div>
</section>