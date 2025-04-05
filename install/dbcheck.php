<?php
$errores = 0;
?>

<div class="panel panel-primary">
        <div class="panel-heading">Comprobación de la conexión de la base de datos</div>
        <div class="panel-body">

<?php
if (isset($_GET['url'])){
    $host   = $_GET['url'];
    $dbname = $_GET['db'];
    $user = $_GET['user'];
    $pass = $_GET['pwd'];
}else if (isset($_POST['url'])){
    $host   = $_POST['url'];
    $dbname = $_POST['db'];
    $user = $_POST['user'];
    $pass = $_POST['pwd'];
}

try{
    $dbh = new PDO("mysql:host=$host", $user, $pass);
}catch(PDOException $ex){
    echo "La información de la base de datos no es correcta.<br />";
    $errores ++;
    echo 'Vuelva a introducir la información del servidor de base de datos.<br />';
    //die(json_encode(array('outcome' => false, 'message' => 'No ha sido posible establecer la conexión')));
}
   
if ($dbh)
{
    if (file_exists('../code/config.php')){
        $i = 1;
        while (file_exists("../code/config_$i.php")){
            $i ++;
        }
        rename("../code/config.php", "../code/config_$i.php");
    }
    
    $txt = '<?php';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '//Configuración de la base de datos';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '$host = "' . $host . '";';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '$user = "' . $user . '";';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '$pass = "' . $pass . '";';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '$dbname = "' . $dbname . '";';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = ' ';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '// Textos por defecto de la interfaz de la aplicación ';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '$nombreAplicacion = "Gestor de material y usuarios"; ';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    $txt = '$nombreSeccion = ""; ';
    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    
    try{
        $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
    }catch(PDOException $ex){
        echo "La base de datos indicada no extiste.<br />";
    }
    
    if (!$db){
        try {
            $dbh = new PDO("mysql:host=$host", $user, $pass);

            $sql = 'CREATE DATABASE ' . $dbname;

            $dbh->exec($sql);
            
            $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        } catch (PDOException $ex){
            $errores ++;
            echo 'La base de datos no se puede crear. Consulte con el administrador.' ;
        }

        if ($db) {
            echo "La base de datos " . $dbname . " se ha creado satisfactoriamente.</br>";
            echo 'Pulse continuar para seguir con la instalación.<br />';
        } else {
            echo 'Error creando la base de datos.'. "</br>";
            $errores ++;
            echo 'Vuelva a introducir la información del servidor de base de datos.<br />';
        }
    }else{
        echo 'La base de datos ya existe.<br />';
        echo 'Pulse continuar para seguir con la instalación.<br />';
    }
}
?>
        </div>
    <div class="panel-footer text-right">
        <?php
            if ($errores <= 0){
                echo '<a class="btn btn-success" href="index.php?stage=dbinstall">Continuar ></a>';
            }else{
                echo '<a class="btn btn-danger" href="index.php?stage=dbdata">Volver a indicar los datos</a>';
            }
        ?>

    </div>

</div>

