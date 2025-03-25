<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM users WHERE username = "' . $_GET['editeduser'] . '"';

$rowsUser = consultaDB($sql, $db);

//echo '<img id="visorimagen" class="img-responsive img-rounded" src="images/No_imagen.jpg">';
//echo $baseURLClient . 'userimages/' . $rowsUser["foto"];
    if (file_exists($baseURL . 'userimages/' . $rowsUser["foto"])){
?>
    <img src="./userimages/<?php echo $rowsUser["foto"]  ?>" alt="<?php echo $rowsUser["nombre"]." ".$rowsUser["apellido1"]." ".$rowsUser["apellido2"]; ?>" 
         id="visorimagen" class="img-responsive img-rounded" />
<?php        
    }else{
?>
    <img src="./userimages/no_imagen.jpg" alt="<?php echo $rowsUser["nombre"]." ".$rowsUser["apellido1"]." ".$rowsUser["apellido2"]; ?>" 
         id="visorimagen" class="img-responsive img-rounded" />
<?php
    }
?> 
