<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$data = array();
//echo 'empezando...<br/>';
if(isset($_GET['files'])) //Si estamos recibiendo los archivos
{	
    //echo 'hay archivos...<br/>';
	$error = false;
	$files = array();

	$uploaddir = '../uploads/';
        
	foreach((array)$_FILES as $file)
	{
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		{
			$files[] = $uploaddir . $file['name'];
                        //echo 'hola move';
		}
		else
		{
		    $error = true;
                    //echo 'hola error';
		}
                //print_r($files);
	}
	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);

        echo json_encode($data);
}
else //si no estamos recibiendo los archivos, recibimos el resto del formulario
{
    //echo 'no hay archivos...<br/>';
    if (isset($_POST['area'])){ //Si se ha mandado información de un formulario
        $codigoArea = $_POST['area'];
        $nombreUbicacion = $_POST['nombre'];
        $nombreAbreviatura = $_POST['abreviatura'];
        //$filenames = $_POST['filenames'];
        //print_r($filenames);
        
        //echo $_POST['filenames'];
        
        //Buscamos si ya existe en la base de datos
        $sql = "SELECT * FROM armarios WHERE area = $codigoArea AND armario LIKE '$nombreAbreviatura'";

        $rows = consultaDB_ALL($sql, $db);
        
        if (count($rows) > 0){
            //$error = 'El código de ubicación ya existe en el área seleccionada.';
            echo 'errorExiste';
        }else{
            if ($_POST['filenames']){
            $foto = end(explode('/', $_POST['filenames'][0]));
            $nombrePlano = $nombreAbreviatura;
            $extensionPlano = '.' . end(explode('.', $foto));
            $foto = $nombrePlano . $extensionPlano;
            //echo '../images/' . $foto;
                while(file_exists($baseURL . 'planosUbicacion/' . $foto)){

                    $nombrePlano .= '_';

                    $foto = $nombrePlano . $extensionPlano;
                }
            }
            rename($_POST['filenames'][0],$baseURL . 'planosUbicacion/' . $foto);
            //Guardamos la información del formulario en la base de datos
            $sql = "INSERT INTO armarios (area, armario, descripcion, plano) VALUES "
                    . "($codigoArea, '$nombreAbreviatura', '$nombreUbicacion', '$foto')";

            consultaDB($sql, $db);

            $sql = "SELECT * FROM armarios WHERE area = $codigoArea AND armario LIKE '$nombreAbreviatura'";

            $rows = consultaDB_ALL($sql, $db);

            if (count($rows) < 1){
                //$error = 'Se ha producido un error en la almacenando en la base de datos';
                echo 'modalErrorDB';
            }
        }
    }else{
        $error = 'Parece que la información no ha llegado correctamente al servidor. Por favor, vuelva a inentarlo.';
        echo 'errorComunicacion';
    }
}


