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
    //echo 'no hay archivos...<br/>';
    if (isset($_POST['id_armario'])){ //Si se ha mandado información de un formulario
        //Comprobamos si el artículo ya existe en la base de datos
        //echo 'hay formulario...<br/>';
        $id_armario = $_POST['id_armario'];

        //movemos la imagen a la carpeta imágenes

        if ($_POST['filenames']){
        $foto = $id_armario . ".jpg";

            while(file_exists($baseURL . 'planosUbicacion/' . $foto)){

                $nombre = substr($foto, 0, -4);
                $extension = substr($foto, -4);

                $foto = $nombre . '_' . $extension;
            }

            rename($_POST['filenames'][0],$baseURL . 'planosUbicacion/' . $foto);
        }else{
            $foto = '';
        }
        if ($foto == '.jpg'){
            $foto = '';
        }
        
        $area = $_POST['area'];
        $armario = $_POST['armario'];
        $descripcion = $_POST['nombre'];
        $plano = $foto;
        $id_armario = $_POST['id_armario'];

        $sql = "UPDATE armarios SET ";
        $sql .= "area = $area";
        $sql .= ", armario = '$armario'";
        $sql .= ", descripcion = '$descripcion'";
        $sql .= ", plano = '$plano'";
        $sql .= " WHERE id_armario = $id_armario";

        echo $sql;
       
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
        require $baseURL . 'code/modal_elemento_actualizado.php'; 
        echo '<script>';
        echo "$.magnificPopup.open({
                items: {
                    src: '#modalElementoActualizado'
                },
                type: 'inline',
                preloader: false,
                modal: true
            }, 0);
            accionMenu('ADM15');";
        echo '</script>';
        

    }
}

