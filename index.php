<?php 
ini_set('display_errors', 0);
?>


<?php
    if (!file_exists("installed")){ //Comprobamos si existe el archivo bandera que marca la instalacion.
        //echo "<script> window.location.replace('./install'); </script>";  //Si existe iniciamos el asistente
		header('Location: ./install/');
    }else{
        require('code/main_functions.php');
        require('code/config.php');
        require('code/conecta_data_base.php');
        session_start();
        if (isset($_SESSION["user"])){  //Comprobamos que corresponden a una sesion valida
            $user = $_SESSION["user"];
            $sql = "SELECT * FROM users WHERE username='$user'";
            $st = $db->query($sql);
            $rowsUser = $st->fetch();

            $sql = "SELECT * FROM userlevels WHERE level=" .$rowsUser['userlevel'];
            $st = $db->query($sql);
            $rowsUserLevel = $st->fetch();


            require 'code/page_html_header.php';
            require 'code/page_body.php';
            require 'code/page_vendorscripts.php';
            require 'code/page_specificvendorscripts.php';
            require 'code/page_themescripts.php';
            require 'code/page_html_tail.php';
        }else{
            require 'code/login.php' ;
        }
    }
    
?>

