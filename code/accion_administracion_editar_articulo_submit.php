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
        
	foreach((array)$_FILES as $file)
	{
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		{
			$files[] = $uploaddir . $file['name'];
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
    if (isset($_POST['codigo'])){ //Si se ha mandado información de un formulario
        //Comprobamos si el artículo ya existe en la base de datos
        $codigo = $_POST['codigo'];  
            //movemos la imagen a la carpeta imágenes
            
            if ($_POST['filenames']){
                $foto = end(explode('/', $_POST['filenames'][0]));
                //echo '../images/' . $foto;
                while(file_exists($baseURL . 'images/' . $foto)){

                    $nombre = substr($foto, 0, -4);
                    $extension = substr($foto, -4);

                    $foto = $nombre . '_' . $extension;
                }

                rename($_POST['filenames'][0],$baseURL . 'images/' . $foto);
            $sqlfoto = "foto = '$foto',";
            }else{
                $foto = 'No_imagen.jpg';
                $sqlfoto = "";
            }

            $centro = $_POST['centro'];
            $departamento = $_POST['departamento'];
            $area = $_POST['area'];
            $codigo = $_POST['codigo'];
            $tipo = $_POST['tipo'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $serie = $_POST['serie'];
            $descripcion = $_POST['descripcion'];
            $ubicacion = $_POST['ubicacion'];
            
            $disponibilidad = 0;
            
            $usuario_alta = $_POST["user"];
            $observaciones = $_POST['observaciones'];
            $fungible = $_POST['fungible'];
            
            $sql = "UPDATE articulos SET "
                    . "id_tipo = $tipo,"
                    . "marca = '$marca',"
                    . "modelo = '$modelo',"
                    . "numeroserie = '$serie',"
                    . "descripcion = '$descripcion',"
                    . "ubicacion = $ubicacion,"
                    . $sqlfoto
                    . "disponibilidad = $disponibilidad,"
                    . "observaciones = '$observaciones',"
                    . "fungible = $fungible "
                    . "WHERE id_articulo = $codigo";
            
           try{
            $st = $db->query($sql);
            if (!$st) {
                echo $sql;
                echo "\nPDO::errorInfo(): \n";
                print_r($db->errorInfo());
                return \NULL;
            }

            }catch (PDOException $e) {
                echo "<scrip> alert('Problema con la base de datos: " . $e->getMessage() . "')</script>";
                return false;
            }
            
            
             /*
            if (consultaDB($sql, $db)){
            require $baseURL . 'code/accion_administracion_nuevo_articulo.php';
                
                
            }else{
                echo 'errorDB';
            }*/
        
    }
}
