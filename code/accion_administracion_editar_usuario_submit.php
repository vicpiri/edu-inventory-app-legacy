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
    if (isset($_POST['username'])){ //Si se ha mandado información de un formulario
        //Comprobamos si el artículo ya existe en la base de datos
        //echo 'hay formulario...<br/>';
        $username = $_POST['username'];

        //movemos la imagen a la carpeta imágenes

        if ($_POST['filenames']){
        $foto = $_POST['username'] . ".jpg";

            while(file_exists($baseURL . 'userimages/' . $foto)){

                $nombre = substr($foto, 0, -4);
                $extension = substr($foto, -4);

                $foto = $nombre . '_' . $extension;
            }

            rename($_POST['filenames'][0],$baseURL . 'userimages/' . $foto);
        }else{
            $foto = '';
        }

        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $userlevel = $_POST['tipo'];
        $mail = $_POST['mail'];
        $telefono = $_POST['telefono'];
        $telefono2 = $_POST['telefono2'];
        $password = $_POST['password'];
        $passwordconfirm = $_POST['paswordconfirm'];
        $fechanacimiento = $_POST['fechanacimiento'];

        $sql = "UPDATE users SET ";
        $sql .= "userlevel= '$userlevel'";
        $sql .= ", nombre='" . $nombre . "'";
        $sql .= ", mail='" . $mail . "'";
        if ($password <> ''){
            $sql .= ", password='" . password_hash($password, PASSWORD_BCRYPT) . "'";
        }
        $sql .= ", apellido1='" . $apellido1 . "'";
        $sql .= ", apellido2='"  . $apellido2 . "'";
        if ($foto <> ''){
            $sql .= ", foto='"  . $foto . "'";
        }
        $sql .= ", telefono='" . $telefono . "'";
        $sql .= ", telefono2='" . $telefono2 . "'";
        $sql .= ", fechadenacimiento= STR_TO_DATE('"  . $fechanacimiento . "', '%d-%m-%Y')";
        $sql .= " WHERE username='" . $username . "'";

        //echo $sql;
       
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
        require $baseURL . 'code/modal_usuario_actualizado.php'; 
        echo '<script>';
        echo "$.magnificPopup.open({
                items: {
                    src: '#modalUsuarioActualizado'
                },
                type: 'inline',
                preloader: false,
                modal: true
            }, 0);
            accionMenu('CON01');";
        echo '</script>';
        

    }
}

