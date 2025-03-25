
<?php
if (isset($_GET['paquete'])){
    $paquete = $_GET['paquete'];
    $tipopaquete = $_GET['tipopaquete'];
    $nombrepaquete = $_GET['nombrepaquete'];
}else if (isset($_POST['paquete'])){
    $paquete = $_POST['paquete'];
    $tipopaquete = $_POST['tipopaquete'];
    $nombrepaquete = $_POST['nombrepaquete'];
}

if (isset($paquete)){
    //Copiamos el paquete del servidor a la carpeta updates
    //Extraemos el contenido del paquete a la raíz de la aplicación (el paquete ya debe llevar las carpetas creadas en su interior desde
    //la raiz.

    if(copy($paquete, "../updates/$nombrepaquete.zip")) {

        $zip = new ZipArchive;
        $res = $zip->open("../updates/$nombrepaquete.zip");
        if ($res === TRUE) {
            $zip->extractTo('../');
            $zip->close();
            //echo 'Paquete extraido';
        } else {
            echo "<script> notification('error', 'Instalación fallida', 'No se ha podido descomprimir el archivo.', 'fa fa-times') </script>";
            die;
            //echo 'Ha habido un error en la extración del paquete';
        }
        /*//Ejecutamos el script de instalación
        if ($tipopaquete === 'module'){
            include '../modules/' . $nombrepaquete . '/install.php';
        }*/
        
        include 'accion_administracion_consultar_actualizaciones.php';
        echo "<script> notification('success', 'Instalación completada', 'Instalación de $nombrepaquete realizada.', 'fa fa-check') </script>";
        //echo "Instalación de $nombrepaquete realizada";
    }else{
        include 'accion_administracion_consultar_actualizaciones.php';
        echo "<script> notification('error', 'Instalación fallida', 'No se ha podido descargar el archivo del servidor.', 'fa fa-times') </script>";
        //echo 'No se ha podido descargar el archivo del servidor. Por favor, vuélvalo a intentar.<br/>';
        //echo $paquete;
    }
    
    
}
