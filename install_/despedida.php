<?php
$errormsg = '';
$target_dir = "assets/images/";
$target_file_config = $target_dir . basename($_FILES["logo"]["name"]);
$target_file = '../' . $target_file_config;
//print_r($_FILES);
//echo $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $errormsg =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

$errores = 0;
//guardamos los datos del formulario
$title = $_POST['titulo'];
$centro = $_POST['nombre'];
$codigocentro = $_POST['codigo'];
$urlBase = $_POST['urlBase'];
/*
if (isset($_FILES["logo"])){
    $uploadOk = 1;
}else{
    $uploadOk = 0;
}
*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $errormsg =  "Lo sentimos, el logotipo no se ha enviado.";
    $uploadOk = 0;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
    } else {
        $errormsg =  "Los sentimos, ha habido un error en el envío del logotipo.";
        $uploadOk = 0;
    }
}
if (isset($_POST['client'])){
    $uploadOk = 1;
}
if (($title == '') or ($centro == '') or ($codigocentro == '') or ($uploadOk == 0)){
    $errores ++;
    echo '';
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">No se puede finalizar el proceso</div>
        <div class="panel-body">
            Ha habido un error.</br></br>
            <?php echo $errormsg ?></br></br>
            Todos los datos del centro son obligatorios.</br></br>
            Por favor, rellene todos los campos del formulario.</br>

        </div>
        <div class="panel-footer text-right">
            <a class="btn btn-danger" href="index.php?stage=centrodata">< Volver al formulario</a>
        </div>
    </div>
    <?php
}else{
    if(!isset($_POST['client'])){
        $txt = '//Personalización de la aplicación';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        $txt = '$title = "' . $title . '";';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        $txt = '$logotipo = "' . $target_file_config . '";';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        $txt = '//URL principal';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        $txt = '$baseURL = __DIR__ . "/../";';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        if (strpos($urlBase, -1) <> '/'){
            $urlBase .= '/';
        }
        $txt = '$baseURLClient = "' . $urlBase . '";';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        $txt = '// Identificación de la instalación';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        $client = uniqid('CL');
        $txt = '$client = "' . $client . '";';
        $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    }else{
        $client = $_POST['client'];
    }
//    $txt = '$nombreSeccion = "";';
//    $myfile = file_put_contents('../code/config.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
     if (file_exists('../install')){
         if (is_dir('../install')){
             rename('../install', '../install_');
         }
     }
     require '../code/config.php';
        try{
            $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            $errormsg = "Ha habido un problema con la conexión a la base de datos.<br />";
            $errores ++;
        }
     //Ahora guardamos la información del centro en la base de datos
     $sql = "INSERT INTO centros (nombre, codigo) VALUES ('$centro', '$codigocentro')";
        $results = $db->query($sql);
        if(!$results) {
            $errores ++;
            die(print_r($db->errorInfo(), TRUE)); 
        }
     
     //Ahora inentamos registrar la instalación en el servidor de actualizaciones
     require_once '../code/update_server.php';
     
     $url = "$update_server/register.php?"
             . "nombre=" . preg_replace("/[^A-Za-z0-9]/", "", $centro)
             . "&client=" . $client;
     
     
     $a = file_get_contents($url);
     
     if ($a === 'instalado'){
     
    ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Finalizando el proceso</div>
        <div class="panel-body">
            La instalación ha concluido.</br> 
            Haga click en finalizar e identifíquese como superadministrador. </br></br>
            A continuación instale los módulos que necesite en la aplicación.</br>

        </div>
        <div class="panel-footer text-right">
            <a class="btn btn-success" href="<?php echo $urlBase; ?>">Finalizar</a>
        </div>
    </div>
    <?php
     }else{
    ?>
    <div class="panel panel-primary">
            <div class="panel-heading">Finalizando el proceso</div>
            <div class="panel-body">
                La instalación ha concluido, pero no se ha podido registrar el producto.</br><br/>
                Necesita que el servidor esté conectado a internet para realizar el registro.<br/><br/>
                Si no registra el producto, no podrá disponer de las actualizaciones y módulos adicionales.<br/>
                Haga click en finalizar e identifíquese como superadministrador para tener un control limitado de la aplicación. </br></br>
                Haga click en registrar para volver a intentar el registro.
                A continuación instale los módulos que necesite en la aplicación.</br>

            </div>
            <div class="panel-footer text-right">
                <form class="form-horizontal" action="index.php" method="post" enctype="multipart/form-data">
                <input name="urlBase" type="hidden" class="form-control" id="urlBase" value="<?php echo $urlBase; ?>">
                <input name="titulo" type="hidden" class="form-control" id="titulo" value="<?php echo $title; ?>">
                <input name="nombre" type="hidden" class="form-control" id="nombre" value="<?php echo $centro; ?>">
                <input name="codigo" type="hidden" class="form-control" id="codigo" value="<?php echo $codigocentro; ?>">
                <input name="client" type="hidden" class="form-control" id="codigo" value="<?php echo $client; ?>">
                <input name="stage" type="hidden" class="form-control" id="stage" value="despedida">

                <a class="btn btn-success" href="<?php echo $urlBase; ?>">Finalizar</a>
                <button class="btn btn-danger" type="submit" name="submit">Registrar</button>
                </form>
            </div>
        
    </div>
   
    <?php
    echo $client;
     }
}
