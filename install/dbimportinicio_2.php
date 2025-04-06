<?php
function vaciatabla ($tabla, &$db){
        
        $sql1 = "TRUNCATE $tabla";
        $results1 = $db->query($sql1);
        if(!$results1) {
            return false;
            die(print_r($db1->errorInfo(), TRUE));
        }
        return true;
}

function cuentatabla ($tabla, &$db){
                
        $sql2 = "SELECT * FROM $tabla";
        
        $results2 = $db->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        //$total = $results2->rowCount();
        return $results2;
}

$server2   = $_POST['url'];
$database2 = $_POST['db'];
$username2 = $_POST['user'];
$password2 = $_POST['pwd'];

if (isset($_POST['fase'])){
    $fase = $_POST['fase'];
}else{
    $fase = 0;
}

switch ($fase) {
    //Importación de usuarios///////////////////////////////////////////////////////////////////////////////////////
    case 0:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
        require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('users', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('users', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('users', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO users ("
                    . "id, "
                    . "username, "
                    . "password, "
                    . "userlevel, "
                    . "nombre, "
                    . "apellido1, "
                    . "apellido2, "
                    . "foto, "
                    . "telefono) VALUES (" 
                    . $db1->quote($dbimport[$a]['id']) . ", " 
                    . $db1->quote($dbimport[$a]['username']) . ", " 
                    . $db1->quote($dbimport[$a]['password']) . ", " 
                    . $db1->quote($dbimport[$a]['userlevel']) . ", " 
                    . $db1->quote($dbimport[$a]['nombre']) . ", "
                    . $db1->quote($dbimport[$a]['apellido1']) . ", " 
                    . $db1->quote($dbimport[$a]['apellido2']) . ", "
                    . $db1->quote($dbimport[$a]['foto']) . ", " 
                    . $db1->quote($dbimport[$a]['telefono']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
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
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100) ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100) ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100) ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
        
    //Importación de artículos//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
    case 1:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
  require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('articulos', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('articulos', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('articulos', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO articulos ("
                    . "id, "
                    . "id_centro, "
                    . "id_departamento, "
                    . "id_area, "
                    . "id_articulo, "
                    . "id_tipo, "
                    . "marca, "
                    . "modelo, "
                    . "numeroserie, "
                    . "descripcion, "
                    . "ubicacion, "
                    . "foto, "
                    . "disponibilidad, "
                    . "fecha_alta, "
                    . "usuario_alta, "
                    . "observaciones) VALUES (" 
                    . $db1->quote($dbimport[$a]['id']) . ", " 
                    . $db1->quote($dbimport[$a]['id_centro']) . ", " 
                    . $db1->quote($dbimport[$a]['id_departamento']) . ", " 
                    . $db1->quote($dbimport[$a]['id_area']) . ", " 
                    . $db1->quote($dbimport[$a]['id_articulo']) . ", " 
                    . $db1->quote($dbimport[$a]['id_tipo']) . ", " 
                    . $db1->quote($dbimport[$a]['marca']) . ", " 
                    . $db1->quote($dbimport[$a]['modelo']) . ", " 
                    . $db1->quote($dbimport[$a]['numeroserie']) . ", "  
                    . $db1->quote($dbimport[$a]['descripcion']) . ", " 
                    . $db1->quote($dbimport[$a]['ubicacion']) . ", "
                    . $db1->quote($dbimport[$a]['foto']) . ", " 
                    . $db1->quote($dbimport[$a]['disponibilidad']) . ", "
                    . $db1->quote($dbimport[$a]['fecha_alta']) . ", " 
                    . $db1->quote($dbimport[$a]['usuario_alta']) . ", " 
                    . $db1->quote($dbimport[$a]['observaciones']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
?>
Importando Artículos
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100); ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100) ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
    
    //Importación de centros/////////////////////////////////////////////////////
    case 2:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
        require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('centros', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('centros', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('centros', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO centros ("
                    . "id, "
                    . "nombre, "
                    . "codigo) VALUES (" 
                    . $db1->quote($dbimport[$a]['id']) . ", " 
                    . $db1->quote($dbimport[$a]['nombre']) . ", " 
                    . $db1->quote($dbimport[$a]['codigo']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
?>
Importando Centros
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100) ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100) ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100) ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
    //Importación de departamentos/////////////////////////////////////////////////////
    case 3:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
        require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('departamentos', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('departamentos', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('departamentos', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO departamentos ("
                    . "id_departamento, "
                    . "centro, "
                    . "abreviatura, "
                    . "descripcion) VALUES (" 
                    . $db1->quote($dbimport[$a]['id_departamento']) . ", " 
                    . $db1->quote(1) . ", " 
                    . $db1->quote($dbimport[$a]['abreviatura']) . ", " 
                    . $db1->quote($dbimport[$a]['descripcion']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
?>
Importando Departamentos
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100); ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100); ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
    //Importación de areas/////////////////////////////////////////////////////
    case 4:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
        require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('areas', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('areas', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('areas', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO areas ("
                    . "id_area, "
                    . "nombre, "
                    . "departamento) VALUES (" 
                    . $db1->quote($dbimport[$a]['id_area']) . ", " 
                    . $db1->quote($dbimport[$a]['nombre']) . ", " 
                    . $db1->quote($dbimport[$a]['departamento']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
?>
Importando Areas
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100); ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100); ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
    //Importación de ubicaciones/////////////////////////////////////////////////////
    case 5:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
        require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('armarios', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('armarios', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('armarios', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO armarios ("
                    . "id_armario, "
                    . "area, "
                    . "armario, "
                    . "descripcion, "
                    . "plano) VALUES (" 
                    . $db1->quote($dbimport[$a]['id_armario']) . ", " 
                    . $db1->quote($dbimport[$a]['area']) . ", " 
                    . $db1->quote($dbimport[$a]['armario']) . ", " 
                    . $db1->quote($dbimport[$a]['descripcion']) . ", " 
                    . $db1->quote($dbimport[$a]['plano']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
?>
Importando Ubicaciones
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100); ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100); ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
    //Importación de tipos de artículo/////////////////////////////////////////////////////
    case 6:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
        require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('tipos', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('tipos', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('tipos', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO tipos ("
                    . "id, "
                    . "nombre) VALUES (" 
                    . $db1->quote($dbimport[$a]['id']) . ", " 
                    . $db1->quote($dbimport[$a]['nombre']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
?>
Importando Tipos de artículo
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100); ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100); ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
    //Importación de salidas/////////////////////////////////////////////////////
    case 7:
        if (isset($_POST['progreso'])){ //Si ya ha empezado el proceso
            $progreso = $_POST['progreso'];
        }else{
            $progreso = 0;
        }
        require '../code/config.php';
        
        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        try{
            $db2 = new PDO("mysql:host=$server2; dbname=$database2", $username2, $password2);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }
        
        if ($progreso > 0){
            $dbimport = cuentatabla('salidas', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
        }else{
            $dbimport = cuentatabla('salidas', $db2);
            $total = $dbimport->rowCount();
            $dbimport = $dbimport->fetchAll();
                        
            if (!vaciatabla('salidas', $db1)){
                echo 'No se ha podido vaciar la tabla "users"';
            }
        }
        $avance = 50;
        
        if (($avance + $progreso) > $total){
            $avance = $total - $progreso;
        }
       
        for ($a = $progreso; $a < ($progreso + $avance); $a ++){
            $sql1 = "INSERT INTO salidas ("
                    . "id_salida, "
                    . "usuario, "
                    . "articulo, "
                    . "fecha, "
                    . "fecha_devolucion, "
                    . "devuelto) VALUES (" 
                    . $db1->quote($dbimport[$a]['id_salida']) . ", " 
                    . $db1->quote($dbimport[$a]['usuario']) . ", " 
                    . $db1->quote($dbimport[$a]['articulo']) . ", " 
                    . $db1->quote($dbimport[$a]['fecha']) . ", " 
                    . $db1->quote($dbimport[$a]['fecha_devolucion']) . ", " 
                    . $db1->quote($dbimport[$a]['devuelto']) . ")";
            $results1 = $db1->query($sql1);
            if(!$results1) {
                return false;
                die(print_r($db1->errorInfo(), TRUE));
            }
            
        }
        
        $progreso = $progreso + $avance;
?>
Importando Salidas
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 100 * ($progreso / $total); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo 100 * ($progreso / $total); ?>%">
        <span class="sr-only"><?php echo 100 * ($progreso / $total); ?>% Complete</span>
    </div>
</div>
Progreso total
<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($fase/7)*100); ?>"
         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($fase/7)*100); ?>%">
        <span class="sr-only"><?php echo round(($fase/7)*100); ?>% Complete</span>
    </div>
</div>
<?php if ($progreso < $total){?>
    <script>
        $('#progreso').load('dbimportinicio.php', {
            progreso:<?php echo $progreso; ?>, 
            total:<?php echo $total; ?> , 
            fase:<?php echo $fase; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }else{ ?>
    <script>
        $('#panelimportacion').load('dbimportinicio.php', {
            progreso:0,
            total:0, 
            fase:<?php echo $fase + 1; ?>,
            url:'<?php echo $server2; ?>',
            db:'<?php echo $database2; ?>',
            user:'<?php echo $username2; ?>',
            pwd:'<?php echo $password2; ?>'            
        });
    </script>
<?php }?>

<?php
        break;
    case 8:
?>

    <div class="panel-heading">Importación de datos</div>
    <div class="panel-body">
        </br>La importación ha finalizado. </br></br>
        Pulse el botón para continuar con la instalación.
    </div>
    <div class="panel-footer text-right">
        <a class="btn btn-success" href="index.php?stage=superuserdata">Continuar</a>
    </div>
<?php
        break;

    default:
        echo 'Se ha producido un error en la importación';
        break;
}



