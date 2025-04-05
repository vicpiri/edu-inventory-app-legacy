<?php
$errores = 0;
?>
<div class="panel panel-primary" id="panelimportacion">
        <div class="panel-heading">Importación de datos</div>
        <div class="panel-body">

<?php

$server2   = $_POST['url'];
$database2 = $_POST['db'];
$username2 = $_POST['user'];
$password2 = $_POST['pwd'];

try{
    $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
}catch(PDOException $ex){
    echo "La información de la base de datos no es correcta.<br />";
    $errores ++;
    echo 'No se puede establecer conexión con la base de datos. Vuelva a introducir la información.<br />';
}

if ($db2)
{        
        echo 'Se ha podido establecer la conexión con la base de datos.<br />';
        echo 'Procediendo a importar la información:<br /><br />';
        ?>
            <div id="progreso">
            
            <script>
                $('#progreso').load('dbimportinicio.php', {
                    url:'<?php echo $server2; ?>',
                    db:'<?php echo $database2; ?>',
                    user:'<?php echo $username2; ?>',
                    pwd:'<?php echo $password2; ?>'
                });
            </script>
            
            </div>
            
        <?php

}
?>
        </div>
    <div class="panel-footer text-right">
        <?php
            if ($errores <= 0){
                
            }else{
                echo '<a class="btn btn-danger" href="index.php?stage=dbimport">Volver a indicar los datos</a>';
            }
        ?>

    </div>

</div>


