<?php
function iniciasesion ($user, $userlevel, &$db){

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION["user"]= $user;
    $_SESSION["userlevel"]= $userlevel;
    

    $fecha=date("Y-m-d H:i:s",time());  //Anotamos la fecha en la que se ha identificado del usuario en la base de datos
    $sql = "INSERT INTO logins (user,time) VALUES ('$user','$fecha')";
    consultaDB ($sql, $db);

    //Borramos los archivos temporales
    borrararchivosusuario($user);
    
    echo "<script> window.location.reload(); </script>";
}

if (isset($_POST["loged"])){ //Si hay datos de identificaci�n los buscamos en la base de datos
    $user = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');
    //$pass = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$user'";
    
    $st = $db->query($sql);
    $rows = $st->fetch();
    
    if (!($rows)){  //Si no existe ninguna correspondencia en la base de datos, devolvemos un mensaje de error
        $user = '';
        $pass = '';
        $error = "El código de usuario que ha introducido no existe.";
        require 'code/page_html_header.php';
        require 'code/page_html_login.php';
        require 'code/page_html_tail.php';
    }else{
        if (!password_verify ($pass , $rows["password"] )){ //Si el usuario existe, comprobamos la contrase�a
            
            $error = "El password que ha introducido no es correcto.<br />";
            $pass = '';
            require 'code/page_html_header.php';
            require 'code/page_html_login.php';
            require 'code/page_html_tail.php';
        }else{
            iniciasesion($user, $rows["userlevel"], $db);
        }
    }
}else{ //Si ya existen datos de identificaci�n
    if (isset($_SESSION["user"])){  //Comprobamos que corresponden a una sesi�n valida
            $user = $_SESSION["user"];
            $sql = "SELECT * FROM users WHERE username='$user'";
            $st = $db->query($sql);
            $rows = $st->fetch();
            
    }else{  //Si no hay una sesi�n abierta, mostramos el formalario de identificaci�n.
        $user = '';
        $pass = '';
        require 'code/page_html_header.php';
        require 'code/page_html_login.php';
        require 'code/page_html_tail.php';
    }
}

