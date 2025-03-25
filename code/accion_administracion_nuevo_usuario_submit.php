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
        //Comprobamos si el usuario ya existe en la base de datos
        
        $username = $_POST['username'];
        $sql = "SELECT * FROM users WHERE username LIKE '$username'";
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
        if($st->rowCount()<=0) {
        
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
                $foto = 'no_imagen.jpg';
            }
            $username = $_POST['username'];
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

            $sql = "INSERT INTO users ("
                    . "username,"
                    . "userlevel,"
                    . "nombre,"
                    . "apellido1,"
                    . "apellido2,"
                    . "mail,"
                    . "password,"
                    . "telefono,"
                    . "telefono2,"
                    . "fechadenacimiento,"
                    . "foto"
                    . ") VALUES ("
                    . "'$username',"
                    . "'$userlevel',"
                    . "'$nombre',"
                    . "'$apellido1',"
                    . "'$apellido2',"
                    . "'$mail',"
                    . "'" . password_hash($password, PASSWORD_BCRYPT) . "',"
                    . "'$telefono',"
                    . "'$telefono2',"
                    . "STR_TO_DATE('"  . $fechanacimiento . "', '%d-%m-%Y'),"
                    . "'$foto')";

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
        }else{
            require $baseURL . 'code/modal_usuario_existe.php'; 
            echo '<script>';
            echo "$.magnificPopup.open({
                    items: {
                        src: '#modalUsuarioExiste'
                    },
                    type: 'inline',
                    preloader: false,
                    modal: true
                }, 0);
                accionMenu('ADM28');";
            echo '</script>';
        }

    }
}

