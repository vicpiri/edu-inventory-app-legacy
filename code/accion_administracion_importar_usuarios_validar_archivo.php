<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';


if (isset($_GET['file'])){
 
    //Leemos el archivo y guardamos su contenido en el array $datosArchivo  
    

    $row = 0;

    $fp = fopen ($_GET['file'], 'r');

    while ($data = fgetcsv ($fp, 3001, ',')) {

            $num = count ($data);

            $row++;
            // Convertimos la infomación del archivo a UTF8
            for ($c=0; $c<$num; $c++) {
                    if (mb_detect_encoding($data[$c], 'UTF-8', true)){
                            $datosArchivo[$row][$c] = $data[$c];
                    }else{
                            $datosArchivo[$row][$c] = utf8_encode($data[$c]);
                    }

            }

    }

    fclose ($fp);

    if (unlink($_GET['file'])){
            //echo "Eliminado el temporal... </br>";
    }else{
            echo "<script>";
            echo     "notification('error', 'No se ha podido eliminar el archivo temporal... ','.' , 'fa fa-exclamation');";
            echo "</script>";
    }
    
    //Comprobamos el tipo de archivo que se ha enviado
    //print_r(busca_columna($datosArchivo,1 ,'Tipo'));
    //print_r($datosArchivo[1]);
    
    if (busca_columna($datosArchivo,1 ,'Función') > -1){//Comprobamos si es de personal buscamos 'Tipo'
        require 'accion_administracion_importar_usuarios_validar_personal.php';
    }else if (busca_columna($datosArchivo,1 ,'CódigoGrupo') > -1){//Comprobamos si es de grupos buscamos 'Código'
        require 'accion_administracion_importar_usuarios_validar_grupos.php';
    }else if (busca_columna($datosArchivo,1 ,'Codigo') > -1){ //Comprobamos si es de alumnado 'NIA'
        require 'accion_administracion_importar_usuarios_validar_alumnado.php';
    }else{
        echo alerta('Parece que el archivo que intenta importar no se corresponde con ningún formato válido.', 'danger');
    }
echo "<script>$('#loading2').html('2');</script>"; //Paramos el spinner de validación
}
?>

     
