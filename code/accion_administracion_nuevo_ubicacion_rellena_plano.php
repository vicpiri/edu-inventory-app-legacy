<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$plano = $_GET['plano'];


if (file_exists($baseURL . 'planosUbicacion/' . $plano) && ($plano <> '')) {
    ?>
    <img src="./planosUbicacion/<?php echo $plano ?>" alt="<?php echo $plano; ?>" 
         id="visorimagen" class="img-responsive img-rounded" />
         <?php
     } else {
         ?>
    <img src="./planosUbicacion/no_plano.jpg" alt="<?php echo $plano; ?>" 
         id="visorimagen" class="img-responsive img-rounded" />
    <?php
}
?> 
