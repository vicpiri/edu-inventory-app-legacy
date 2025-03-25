<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$data = array();

if(isset($_GET['files'])) //Si estamos recibiendo los archivos
{	
	$error = false;
	$files = array();

	$uploaddir = '../uploads/';
        
	foreach($_FILES as $file)
	{
                $name = time();
		if(move_uploaded_file($file['tmp_name'], $uploaddir . $name))
		{
			$files[] = $uploaddir . $name; //ponemos un nombre aleatorio al archivo temporal
		}
		else
		{
		    $error = true;
		}
	}
	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
        echo json_encode($data);
}
else //si no estamos recibiendo los archivos, recibimos el resto del formulario
{
    echo 'No se ha recibido el archivo.';
}
