<?php
if (!isset($db)){
    $db = new PDO('mysql:host='. $host . ';dbname=' . $dbname, $user, $pass);
    
    $sql="SET NAMES 'utf8'"; //configuramos la conexi�n para no tener problemas con los acentos
    $st = $db->query($sql);
}else{
    //echo 'La base de datos ya se había conectado';
}

