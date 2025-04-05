<?php
// $accionkey, $tipo
/* INSTRUCCIONES PARA GENERARA EL ARCHIVO DE PLUGINS
 * 
 * La variable $accionkey está declarada y la utilizamos para averiaguar qué
 * parte de la aplicación estamos ejecutando. Utilizamos un controlador IF para
 * decidir si el código debe ser añadido o no a la página.
 * 
 * La variable $tipo también está inicializada con el valor 'PRE' o el valor
 * 'POST'. Dependiendo si se está ejecutando antes o después del código principal
 * de la sección cargada. Para seleccionar el método de ejecución utilizamos un
 * switch.
 * 
 * Para finalizar, después de todas las condiciones debemos poner el código por
 * defecto que se ejecutará en cualquier caso.
 * 
 * Las zonas accesibles en core son:
 * 
 * .notifications = área de notificaciones de usuario en la parte superior
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nivel = $_SESSION['userlevel'];


switch ($tipo) {
    case 'PRE':


        break;
    
    case 'POST':
        if ($accionkey == 'PCO00'){
            
            // Panel de últimos artículos prestados 
            if (intval($nivel) <= 2){
                echo "<script>
                ajaxAppend('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_ultimos_prestados.php', '#cppanels');
                </script>";
            }
            
            // Widget préstamos totales
            if (intval($nivel) <= 2){
                echo "<script>
                ajaxAppend('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_WIDG_prestamos_totales.php', '#cpwidgets');
                </script>";
            }
                
            // Widget préstamos hechos por mi pendientes de devolución
            if (intval($nivel) <= 2){
                echo "<script>
                ajaxAppend('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_WIDG_prestado_por_mi.php', '#cpwidgets');
                </script>";
            }
            
        }else if ($accionkey == 'CON02'){
            
            // Panel de últimos artículos prestados 
            if (intval($nivel) <= 2){
                echo "<script>
                ajaxAppend('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_consultar_historico.php', '#consultarArticulos .row:eq(1)');
                </script>";
            }
            
        }
        
        echo "<script>
        ajaxUpdate('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_WIDG_prestamos_debidos.php', '.notifications', '#WIDdebidos');
        </script>";


        break;

    default:
        break;
}
