<?php
function vaciatabla ($tabla, $host, $db, $user, $psw){
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$db", $user, $psw);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }

        $sql1 = "TRUNCATE $tabla";
        $results1 = $db1->query($sql1);
        if(!$results1) {
            return false;
            die(print_r($db1->errorInfo(), TRUE));
        }
        return true;
}

function cuentatabla ($tabla, $host, $db, $user, $psw){
        try{
            $db2 = new PDO("mysql:host=$host; dbname=$db", $user, $psw);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        $sql2 = "SELECT * FROM $tabla";
        
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        $total = $results2->rowCount();
        return $total;
}

$server2   = $_POST['url'];
$database2 = $_POST['db'];
$username2 = $_POST['user'];
$password2 = $_POST['pwd'];

//if (isset($_POST['progreso'])){
//    $progreso = $_POST['progreso'] + 1;
//    $fase = $_POST['fase'];
//    $total = $_POST['total'];
//}else{
//    $progreso = 0;
//    $total = 0;
//    $fase = 0;
//}
if (isset($_POST['fase'])){
    $fase = $_POST['fase'];
}else{
    $fase = 0;
}

switch ($fase) {
    case 0:
        
        require '../code/config.php';

        $total = cuentatabla('users', $server2, $database2, $username2, $password2);
        /*
        if (!vaciatabla('users', $host, $dbname, $user, $pass)){
            //$errores ++;
            echo 'No se ha podido vaciar la tabla "users"';
        }*/
        
        echo $total;
        echo '</br>';
        
        /*
        foreach ($results2 as $dbimport){
            
            $sql1 = "INSERT INTO users ("
                    . "id, "
                    . "username, "
                    . "password, "
                    . "userlevel, "
                    . "nombre, "
                    . "apellido1, "
                    . "apellido2, "
                    . "foto, "
                    . "telefono, "
                    . "telefono2, "
                    . "fechadenacimiento, "
                    . "mail) VALUES (" 
                    . $db1->quote($dbimport['id']) . ", " 
                    . $db1->quote($dbimport['username']) . ", " 
                    . $db1->quote(password_hash($dbimport['password'], PASSWORD_BCRYPT)) . ", " 
                    . $db1->quote($dbimport['userlevel']) . ", " 
                    . $db1->quote($dbimport['nombre']) . ", "
                    . $db1->quote($dbimport['apellido1']) . ", " 
                    . $db1->quote($dbimport['apellido2']) . ", "
                    . $db1->quote($dbimport['foto']) . ", " 
                    . $db1->quote($dbimport['telefono']) . ", " 
                    . $db1->quote($dbimport['telefono2']) . ", "
                    . $db1->quote($dbimport['fechadenacimiento']) . ", "
                    . $db1->quote($dbimport['mail']) . ")";
                //echo '|' . $dbimport['password'] . '|' . md5($dbimport['password']) . '<br/>';
                $results1 = $db1->query($sql1);
                if(!$results1) {
                    $errores ++;
                    die(print_r($db->errorInfo(), TRUE));

                }else{
                    $i ++;
                }
        }*/
        //echo $i . ' usuarios importados.<br />';
        
?>
Importando Usuarios
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fase*10; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fase*10; ?>%">
        <span class="sr-only"><?php echo $fase*10; ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < 100){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:<?php echo $server2; ?>,
            db:<?php echo $database2; ?>,
            user:<?php echo $username2; ?>,
            pwd:<?php echo $password2; ?>            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:<?php echo $server2; ?>,
            db:<?php echo $database2; ?>,
            user:<?php echo $username2; ?>,
            pwd:<?php echo $password2; ?>            
        });
    </script>
<?php }?>

<?php
        break;
        
        
    case 1:
?>
Importando Artículos
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progreso; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progreso; ?>%">
        <span class="sr-only"><?php echo $progreso; ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fase*10; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fase*10; ?>%">
        <span class="sr-only"><?php echo $fase*10; ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < 100){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:<?php echo $progreso; ?>, fase:<?php echo $fase; ?>});
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:0, fase:<?php echo $fase + 1; ?>});
    </script>
<?php }?>

<?php
        break;
    
    
    case 2:
?>
Importando Centros
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progreso; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progreso; ?>%">
        <span class="sr-only"><?php echo $progreso; ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fase*10; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fase*10; ?>%">
        <span class="sr-only"><?php echo $fase*10; ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < 100){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:<?php echo $progreso; ?>, fase:<?php echo $fase; ?>});
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:0, fase:<?php echo $fase + 1; ?>});
    </script>
<?php }?>

<?php
        break;
    case 3:
?>
Importando Departamentos
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progreso; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progreso; ?>%">
        <span class="sr-only"><?php echo $progreso; ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fase*10; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fase*10; ?>%">
        <span class="sr-only"><?php echo $fase*10; ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < 100){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:<?php echo $progreso; ?>, fase:<?php echo $fase; ?>});
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:0, fase:<?php echo $fase + 1; ?>});
    </script>
<?php }?>

<?php
        break;
    case 4:
?>
Importando Areas
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progreso; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progreso; ?>%">
        <span class="sr-only"><?php echo $progreso; ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fase*10; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fase*10; ?>%">
        <span class="sr-only"><?php echo $fase*10; ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < 100){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:<?php echo $progreso; ?>, fase:<?php echo $fase; ?>});
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:0, fase:<?php echo $fase + 1; ?>});
    </script>
<?php }?>

<?php
        break;
    case 5:
?>
Importando Ubicaciones
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progreso; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progreso; ?>%">
        <span class="sr-only"><?php echo $progreso; ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fase*10; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fase*10; ?>%">
        <span class="sr-only"><?php echo $fase*10; ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < 100){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:<?php echo $progreso; ?>, fase:<?php echo $fase; ?>});
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:0, fase:<?php echo $fase + 1; ?>});
    </script>
<?php }?>

<?php
        break;
    case 6:
?>
Importando Tipos de artículo
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progreso; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progreso; ?>%">
        <span class="sr-only"><?php echo $progreso; ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fase*10; ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $fase*10; ?>%">
        <span class="sr-only"><?php echo $fase*10; ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < 100){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:<?php echo $progreso; ?>, fase:<?php echo $fase; ?>});
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {progreso:0, fase:<?php echo $fase + 1; ?>});
    </script>
<?php }?>

<?php
        break;
    case 7:
?>
Final
<?php
        break;

    default:
        echo 'Se ha producido un error en la importación';
        break;
}
?>



