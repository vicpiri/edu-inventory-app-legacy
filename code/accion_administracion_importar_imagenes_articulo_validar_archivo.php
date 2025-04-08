<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

if (isset($_GET['file'])){
    
    $archivo = $_GET['file'];
    $directorio = $_GET['file'] . '-dir/';
    $zip = new ZipArchive;
    if ($zip->open($archivo) === TRUE) {
        $zip->extractTo($directorio);
        $zip->close();
        //echo 'El archivo se ha descomprimido';
        unlink($archivo);
//        array_map('unlink', glob("$directorio/*.*"));
//        rmdir($directorio);
    } else {
        echo 'El archivo no se ha recibido';
    }
    
    $correctos = [];
    $erroneos = [];

    //print_r(glob("$directorio/*.*"));
    foreach ((array)glob("$directorio/*.*") as $nom_archivo) {
        //comprueba_imagen($nom_archivo);
        
        $nombreC = basename($nom_archivo);

        $nombre = explode('.', $nombreC)[0];
        
        $sql = "SELECT * FROM articulos WHERE id_articulo LIKE '$nombre'";
        //echo '<br/>' . $sql . '<br/>';
        //echo $nombre[0];
        $rows = consultaDB_ALL($sql, $db);
        
        //echo ' - ' . count($rows);
        if (count($rows)>0){
            $articulo = $rows[0]['marca'] . ' / ' . $rows[0]['modelo'];
            array_push($correctos, [$nombreC, $nom_archivo, $articulo, $rows[0]['id_articulo']]);
        }else{
            array_push($erroneos, [$nombreC, $nom_archivo, '-']);
        }
    }
    //array_map('comprueba_imagen', glob("$directorio/*.*"));
    
//    echo '<br/>Correctos <br/>';
//    print_r($correctos);
//    echo '<br/>Erroneos <br/>';
//    print_r($erroneos);
    
    //Leemos el archivo y guardamos su contenido en el array $datosArchivo  
    
}
require_once '../code/accion_administracion_importar_imagenes_articulo_presentacion.php';
echo "<script>$('#loading2').html('2');</script>"; //Paramos el spinner de validación
                



