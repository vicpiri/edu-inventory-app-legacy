<?php
$errores = 0;
set_time_limit(0);
ignore_user_abort(1);
?>
<div class="panel panel-primary">
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
        echo 'Procediendo a importar la información:<br />';
        
        echo '</br>';
        echo '- Iniciando la importación de los usuarios.<br />';
        
        $sql2 = "SELECT * FROM users";
        
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        
        require '../code/config.php';

        try{
            $db1 = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        }catch(PDOException $ex){
            echo "La base de datos indicada no extiste.<br />";
        }

        $sql1 = "TRUNCATE users";
        $results1 = $db1->query($sql1);
        if(!$results1) {
            $errores ++;
            die(print_r($db1->errorInfo(), TRUE));
            
        }
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
        }
        echo $i . ' usuarios importados.<br />';
        
        //Importar artículos
        
        echo '- Iniciando la importación de los artículos.<br />';
        $i = 0;
        
        $sql2 = "SELECT * FROM articulos";
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        
        
        $sql1 = "TRUNCATE articulos";
        
        $results1 = $db1->query($sql1);
        if(!$results1) {
            $errores ++;
            die(print_r($db1->errorInfo(), TRUE));
            
        }
        
        foreach ($results2 as $dbimport){
            
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
                    . "observaciones, "
                    . "fungible) VALUES (" 
                    . $db1->quote($dbimport['id']) . ", " 
                    . $db1->quote($dbimport['id_centro']) . ", "
                    . $db1->quote($dbimport['id_departamento']) . ", "
                    . $db1->quote($dbimport['id_area']) . ", "
                    . $db1->quote($dbimport['id_articulo']) . ", "
                    . $db1->quote($dbimport['id_tipo']) . ", "
                    . $db1->quote($dbimport['marca']) . ", "
                    . $db1->quote($dbimport['modelo']) . ", "
                    . $db1->quote($dbimport['numeroserie']) . ", "
                    . $db1->quote($dbimport['descripcion']) . ", "
                    . $db1->quote($dbimport['ubicacion']) . ", "
                    . $db1->quote($dbimport['foto']) . ", "
                    . $db1->quote($dbimport['disponibilidad']) . ", "
                    . $db1->quote($dbimport['fecha_alta']) . ", "
                    . $db1->quote($dbimport['usuario_alta']) . ", "
                    . $db1->quote($dbimport['observaciones']) . ", "
                    . "0)";
                try{
                    $results1 = $db1->query($sql1);
                } catch (PDOException $ex) {
                    echo "Error: ".$ex;
                }
                
                if(!$results1) {
                    $errores ++;
                    die(print_r($db->errorInfo(), TRUE));

                }else{
                    $i ++;
                }
        }
        echo $i . ' artículos importados.<br />';        
        
        //Importar centros
        
        echo '- Iniciando la importación de los centros.<br />';
        $i = 0;
        
        $sql2 = "SELECT * FROM centros";
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        
        
        $sql1 = "TRUNCATE centros";
        
        $results1 = $db1->query($sql1);
        if(!$results1) {
            $errores ++;
            die(print_r($db1->errorInfo(), TRUE));
            
        }
        
        foreach ($results2 as $dbimport){
            
            $sql1 = "INSERT INTO centros ("
                    . "id, "
                    . "nombre, "
                    . "codigo) VALUES (" 
                    . $db1->quote($dbimport['id']) . ", " 
                    . $db1->quote($dbimport['nombre']) . ", "
                    . $db1->quote($dbimport['codigo']) . ")";
                try{
                    $results1 = $db1->query($sql1);
                } catch (PDOException $ex) {
                    echo "Error: ".$ex;
                }
                
                if(!$results1) {
                    $errores ++;
                    die(print_r($db->errorInfo(), TRUE));

                }else{
                    $i ++;
                }
        }
        echo $i . ' centros importados.<br />';
        
        //Importar departamentos
        
        echo '- Iniciando la importación de los departamentos.<br />';
        $i = 0;
        
        $sql2 = "SELECT * FROM departamentos";
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        
        
        $sql1 = "TRUNCATE departamentos";
        
        $results1 = $db1->query($sql1);
        if(!$results1) {
            $errores ++;
            die(print_r($db1->errorInfo(), TRUE));
            
        }
        
        foreach ($results2 as $dbimport){
            
            $sql1 = "INSERT INTO departamentos ("
                    . "id_departamento, "
                    . "centro, "
                    . "abreviatura, "
                    . "descripcion) VALUES (" 
                    . $db1->quote($dbimport['id_departamento']) . ", " 
                    . $db1->quote($dbimport['centro']) . ", "
                    . $db1->quote($dbimport['abreviatura']) . ", "
                    . $db1->quote($dbimport['descripcion']) . ")";
                try{
                    $results1 = $db1->query($sql1);
                } catch (PDOException $ex) {
                    echo "Error: ".$ex;
                }
                
                if(!$results1) {
                    $errores ++;
                    die(print_r($db->errorInfo(), TRUE));

                }else{
                    $i ++;
                }
        }
        echo $i . ' departamentos importados.<br />';
        
        //Importar areas
        
        echo '- Iniciando la importación de los áreas.<br />';
        $i = 0;
        
        $sql2 = "SELECT * FROM areas";
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        
        
        $sql1 = "TRUNCATE areas";
        
        $results1 = $db1->query($sql1);
        if(!$results1) {
            $errores ++;
            die(print_r($db1->errorInfo(), TRUE));
            
        }
        
        foreach ($results2 as $dbimport){
            
            $sql1 = "INSERT INTO areas ("
                    . "id_area, "
                    . "nombre, "
                    . "departamento) VALUES (" 
                    . $db1->quote($dbimport['id_area']) . ", " 
                    . $db1->quote($dbimport['nombre']) . ", "
                    . $db1->quote($dbimport['departamento']) . ")";
                try{
                    $results1 = $db1->query($sql1);
                } catch (PDOException $ex) {
                    echo "Error: ".$ex;
                }
                
                if(!$results1) {
                    $errores ++;
                    die(print_r($db->errorInfo(), TRUE));

                }else{
                    $i ++;
                }
        }
        echo $i . ' áreas importadas.<br />';
        
        //Importar armarios
        
        echo '- Iniciando la importación de los armarios.<br />';
        $i = 0;
        
        $sql2 = "SELECT * FROM armarios";
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        
        
        $sql1 = "TRUNCATE armarios";
        
        $results1 = $db1->query($sql1);
        if(!$results1) {
            $errores ++;
            die(print_r($db1->errorInfo(), TRUE));
            
        }
        
        foreach ($results2 as $dbimport){
            
            $sql1 = "INSERT INTO armarios ("
                    . "id_armario, "
                    . "area, "
                    . "armario, "
                    . "descripcion, "
                    . "plano) VALUES (" 
                    . $db1->quote($dbimport['id_armario']) . ", " 
                    . $db1->quote($dbimport['area']) . ", "
                    . $db1->quote($dbimport['armario']) . ", "
                    . $db1->quote($dbimport['descripcion']) . ", "
                    . $db1->quote($dbimport['plano']) . ")";
                try{
                    $results1 = $db1->query($sql1);
                } catch (PDOException $ex) {
                    echo "Error: ".$ex;
                }
                
                if(!$results1) {
                    $errores ++;
                    die(print_r($db->errorInfo(), TRUE));

                }else{
                    $i ++;
                }
        }
        echo $i . ' armarios importados.<br />';
        
        //Importar tipos
        
        echo '- Iniciando la importación de los tipos de artículo.<br />';
        $i = 0;
        
        $sql2 = "SELECT * FROM tipos";
        $results2 = $db2->query($sql2);
        if(!$results2) {
            $errores ++;
            die(print_r($db2->errorInfo(), TRUE));
            
        }
        
        
        $sql1 = "TRUNCATE tipos";
        
        $results1 = $db1->query($sql1);
        if(!$results1) {
            $errores ++;
            die(print_r($db1->errorInfo(), TRUE));
            
        }
        
        foreach ($results2 as $dbimport){
            
            $sql1 = "INSERT INTO tipos ("
                    . "id, "
                    . "nombre) VALUES (" 
                    . $db1->quote($dbimport['id']) . ", " 
                    . $db1->quote($dbimport['nombre']) . ")";
                try{
                    $results1 = $db1->query($sql1);
                } catch (PDOException $ex) {
                    echo "Error: ".$ex;
                }
                
                if(!$results1) {
                    $errores ++;
                    die(print_r($db->errorInfo(), TRUE));

                }else{
                    $i ++;
                }
        }
        echo $i . ' tipos importados.<br />';
}
?>
        </div>
    <div class="panel-footer text-right">
        <?php
            if ($errores <= 0){
                echo '<a class="btn btn-success" href="index.php?stage=superuserdata">Continuar ></a>';
            }else{
                echo '<a class="btn btn-danger" href="index.php?stage=dbimport">Volver a indicar los datos</a>';
            }
        ?>

    </div>

</div>


