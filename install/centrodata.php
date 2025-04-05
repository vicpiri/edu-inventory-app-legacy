<?php
$errores = 0;
$errormsg = '';
if (isset($_POST['user'])){
    $superuser = $_POST['user'];
    $passw =  $_POST['pwd'];
    $passw2 =  $_POST['pwd2'];

    require '../code/config.php';

    $server   = $host;
    $database = $dbname;
    $username = $user;
    $password = $pass;

    try{
        $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
    }catch(PDOException $ex){
        $errormsg = "Ha habido un problema con la conexión a la base de datos.<br />";
        $errores ++;
    }
}else{
    $superuser = 'dummy';
    $passw =  'dummy';
    $passw2 =  'dummy';

}

if (($superuser == '') or ($passw == '') or ($passw <> $passw2)){
    $errores ++;
}else{
    if (isset($_POST['user'])){
        $passw = password_hash($passw, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password, userlevel, nombre, foto) VALUES ('$superuser', '$passw', 0, 'Superusuario', 'super.jpg')";
        $results = $db->query($sql);
        if(!$results) {
            $errores ++;
            die(print_r($db->errorInfo(), TRUE)); 
        }
    }
}

if ($errores > 0){
?>
    <div class="panel panel-primary">

        <header class="panel-heading">
            <h2 class="panel-title">Creación del superusuario</h2>
        </header>
        
        <div class="panel-body">
            Existen errores en la información introducida. Por favor, revise que:</br></br>
            - Haya completado todos los campos del formulario anterior.</br>
            - Haya introducido la misma contraseña en los dos campos reservados para tal efecto.</br>
            </br>
            <?php echo $errormsg;?>

        </div>

        <div class="panel-footer text-right">
            <a class="btn btn-danger" href="index.php?stage=superuserdata">< Volver al formulario</a>
        </div>

    </div>
<?php
}else{
?>
    <div class="panel panel-primary">

        <header class="panel-heading">
            <h2 class="panel-title">Información del centro</h2>
        </header>
        <form class="form-horizontal" action="index.php" method="post" enctype="multipart/form-data">
        <div class="panel-body">

            <div class="form-group">
              <label class="control-label col-sm-4" for="urlBase">URL Base de la aplicación:</label>
              <div class="col-sm-8">
                  <input name="urlBase" type="text" class="form-control" id="urlBase" placeholder="URL Utilizada para acceder a la aplicación">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="titulo">Título de la aplicación:</label>
              <div class="col-sm-8">
                  <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Este título aparecerá en la pestaña del navegador">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="nombre">Nombre del centro:</label>
              <div class="col-sm-8">
                  <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Introduzca el nombre del centro">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="codigo">Código del centro:</label>
              <div class="col-sm-8">
                  <input name="codigo" type="text" class="form-control" id="codigo" placeholder="Introduzca el código del centro">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="logo">Logo Centro:</label>
              <div class="col-sm-8">
                  <input name="logo" type="file" class="form-control" id="logo" placeholder="Logotipo">
              </div>
              <img id="visorimagen2" class="col-md-12" >
            </div>
            <div class="form-group center">
                  <img id="visorimagen" >
            </div>
        </div>

        <div class="panel-footer text-right">
            <input name="stage" type="hidden" class="form-control" id="stage" value="despedida">
            <button class="btn btn-success" type="submit" class="btn btn-default" name="submit">Continuar ></button>
        </div>
        </form>
    </div>
<script>
/*$("#logo").change(function(event){
    if($("#imagen").val() === ''){
        $('#visorimagen').fadeIn("fast").attr('src','images/No_imagen.jpg');
    }else{
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#visorimagen").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    }    
});*/

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#visorimagen').hide();
            $('#visorimagen').attr('src', e.target.result);
            $('#visorimagen2').attr('src', e.target.result);
            var img = document.getElementById('visorimagen'); 
            //or however you get a handle to the IMG
            var width = img.width;
            var height = img.height;
            if( height >= 60 && height <= 110 ) {
                
            }else{
                alert('La altura de la imagen debe tener entre 60 y 110 px. Se recomienda que el diseño sea apaisado. ');
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#logo").change(function(){
    readURL(this);
    
});
</script>

<?php
}