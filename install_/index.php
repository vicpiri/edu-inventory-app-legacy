<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Instalación del Gestor de Inventarios y Usuarios</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Instalación del Gestor de Inventario y Usuarios</a>
        </div>
        
      </div>
    </nav>
      <div class="container theme-showcase col-md-6 col-md-offset-3" role="main">
          <?php
          if (file_exists('../desarrollo.php')){
                ini_set('display_errors', 1);
            }else{
                ini_set('display_errors', 0);
            }
          if ((!isset($_GET['stage'])) && (!isset($_POST['stage']))){
          ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">¡Bienvenido!</div>
                    <div class="panel-body">
                        Bienvenido al asistente de instalación del Gestor de Inventario y Usuarios. </br></br>

                        Por favor, siga las instrucciones para completar la instalación.
                    </div>
                    <div class="panel-footer text-right">
                        <a class="btn btn-success" href="index.php?stage=servercheck">Continuar ></a>
                    </div>
                </div>
          <?php
          }elseif (($_GET['stage'] == 'servercheck') or ($_POST['stage'] == 'servercheck')) {
              require 'servercheck.php';     
          }elseif (($_GET['stage'] == 'dbdata') or ($_POST['stage'] == 'dbdata')){
              require 'dbdata.php';
          }elseif (($_GET['stage'] == 'dbcheck') or ($_POST['stage'] == 'dbcheck')){
              require 'dbcheck.php';
          }elseif (($_GET['stage'] == 'dbinstall') or ($_POST['stage'] == 'dbinstall')){
              require 'dbinstall.php';     
          }elseif (($_GET['stage'] == 'dbimportquestion') or ($_POST['stage'] == 'dbimportquestion')){
              require 'dbimportquestion.php';     
          }elseif (($_GET['stage'] == 'dbimport') or ($_POST['stage'] == 'dbimport')){
              require 'dbimport.php';     
          }elseif (($_GET['stage'] == 'superuserdata') or ($_POST['stage'] == 'superuserdata')){
              require 'superuserdata.php';
          }elseif (($_GET['stage'] == 'centrodata') or ($_POST['stage'] == 'centrodata')){
              require 'centrodata.php';
          }elseif (($_GET['stage'] == 'despedida') or ($_POST['stage'] == 'despedida')){
              require 'despedida.php';
          }elseif (($_GET['stage'] == 'dbimportselect') or ($_POST['stage'] == 'dbimportselect')){
              require 'dbimportselect.php';
          }
          ?>
          
          
              
              
              
      </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

<?php

//Bienvenida

//Comprobar caracteríaticas del seervidor en el que se está ejecutando el script    

//Introduzca los datos de la DB

//Prueba de conexión con la base de datos

//Comprobar la existencia de las tablas en la base de datos, si no existe, se crea

//Preguntar si se desea importar la información de una base de datos antigua

//Introduzca los datos del centro

//Introduzca los datos del superusuario


