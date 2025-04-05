<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["user"])){
    //Acciones previas a la destrucción de la sesión
    $user = $_SESSION["user"];
    //borrararchivosusuario($user);

    session_unset();
    session_destroy();

    echo "<script> window.location.replace(''); </script>";
}	


