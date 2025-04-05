<?php
require '../code/config.php';

$server   = $host;
$database = $dbname;
$username = $user;
$password = $pass;

try{
    $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
}catch(PDOException $ex){
    echo "Ha habido un problema con la conexión a la base de datos.<br />";
    $errores ++;
}

$sql = "SELECT * FROM users WHERE userlevel = 0";
$results = $db->query($sql);
if(!$results) {
    die(print_r($db->errorInfo(), TRUE));
}
if($results->rowCount()>0) {
?>
<div class="panel panel-primary">
                    
    <header class="panel-heading">
        <h2 class="panel-title">Creación del superusuario</h2>
    </header>
    <div class="panel-body">
        Ya existe un superusuario creado en el sistema.</br>
        Por favor, continúe con la instalación.
    </div>

    <div class="panel-footer text-right">
        <a class="btn btn-success" href="index.php?stage=centrodata">Continuar ></a>
    </div>
</div>
<?php    
}else{

?>

<div class="panel panel-primary">
                    
    <header class="panel-heading">
        <h2 class="panel-title">Creación del superusuario</h2>
    </header>
    <form class="form-horizontal" action="index.php" method="post">
    <div class="panel-body">

        <div class="form-group">
          <label class="control-label col-sm-4" for="user">Nombre Usuario:</label>
          <div class="col-sm-8">
              <input name="user" type="text" class="form-control" id="user" placeholder="Introduzca el nombre de usuario">
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-4" for="pwd">Password:</label>
          <div class="col-sm-8"> 
              <input name="pwd" type="password" class="form-control" id="pwd" placeholder="Introduzca el password">
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-4" for="pwd2"> Repita Password:</label>
          <div class="col-sm-8"> 
              <input name="pwd2" type="password" class="form-control" id="pwd2" placeholder="Vuelva a introducir el password">
            <input name="stage" type="hidden" class="form-control" id="stage" value="centrodata">
          </div>
        </div>


    </div>

    <div class="panel-footer text-right">
        <button class="btn btn-success" type="submit" class="btn btn-default">Continuar ></button>
    </div>
    </form>
</div>
<?php

}
