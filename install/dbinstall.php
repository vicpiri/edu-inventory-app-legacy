<div class="panel panel-primary">
        <div class="panel-heading">Instalación de la estructura de la base de datos</div>
        <div class="panel-body">
<?php
$errores = 0;
require '../code/config.php';

$server   = $host;
$database = $dbname;
$username = $user;
$password = $pass;

    try{
        $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
    }catch(PDOException $ex){
        echo "Ha habido un problema con la conexión a la base de datos.<br />";
        $errores ++;
    }
    
    $files = glob('./sql/*.sql');
    //print_r($files);
    
foreach ($files as $file) {
    $table = explode('.', basename($file));
    //print_r($table);
    $results = $db->query("SHOW TABLES LIKE '$table[0]'");
    if(!$results) {
        die(print_r($db->errorInfo(), TRUE));
    }
    if($results->rowCount()>0) {
        echo "La tabla $table[0] ya existe. </br>";
    }else{
        $filename = $file;
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($filename);
        // Loop through each line
        foreach ($lines as $line)
        {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            $db->query($templine);
            // Reset temp variable to empty
            $templine = '';
        }
        }
         echo "Se ha ejecutado el archivo " . $filename . " correctamente.<br />";
    }
}
?>
</div>
    <div class="panel-footer text-right">
        <?php
            if ($errores <= 0){
                echo '<a class="btn btn-success" href="index.php?stage=dbimportquestion">Continuar ></a>';
            }else{
                echo '<a class="btn btn-danger" href="index.php">Volver a iniciar la instalación</a>';
            }
        ?>

    </div>

</div>

