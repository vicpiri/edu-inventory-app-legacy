<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$error = '';
if (isset($_GET['area'])){
    $codigoCentro = $_GET['centro'];
    $codigoDepartamento = $_GET['departamento'];
    $nombreArea = $_GET['area'];
    
//Buscamos si ya existe en la base de datos
    $sql = "SELECT * FROM areas WHERE departamento = $codigoDepartamento AND nombre LIKE '$nombreArea'";
    
    $rows = consultaDB_ALL($sql, $db);
    
    if (count($rows) > 0){
        $error = 'El área ya existe en el departamento seleccionado.';
    }else{
        //Guardamos la información del formulario en la base de datos
        $sql = "INSERT INTO areas (nombre, departamento) VALUES ('$nombreArea', $codigoDepartamento)";
        
        consultaDB($sql, $db);
        
        $sql = "SELECT * FROM areas WHERE departamento = $codigoDepartamento AND nombre LIKE '$nombreArea'";

        $rows = consultaDB_ALL($sql, $db);

        if (count($rows) < 1){
            $error = 'Se ha producido un error en la almacenando en la base de datos';
        }
    }

}else{
    $error = 'Parece que la información no ha llegado correctamente al servidor. Por favor, vuelva a inentarlo.';
}

//Mostramos los modales con la información del resultado

if ($error === ''){
    //Si no hay error, mostramos el cuadro de diálogo de éxito
    echo '<div id="custom-content" class="modal-block modal-block-md modal-block-success">';
    
    $contenido = '<div class="modal-wrapper"><div class="modal-icon"><i class="fa fa-check"></i></div>
        <div class="modal-text"><h4>Guardado</h4><p>El registro se ha efectuado correctamente.</p></div></div>';
    $tipo = '';
    $icono = '';
    $footer = '<div class="row"><div class="col-md-12 text-right"><button class="btn btn-success modal-reload-admin-nuevo-ubic">OK</button></div></div>';
    echo genera_panel('Acción enviada', '', '', $contenido, $footer, $tipo, $icono);

    echo '</div>';
}else{
    //Si hay error, lo mostramos en un cuadro de diálogo.
    echo '<div id="custom-content" class="modal-block modal-block-md modal-block-danger">';
    
    $contenido = '<div class="modal-wrapper">
                    <div class="modal-icon">
                    <i class="fa fa-times-circle"></i>
                    </div>
                    <div class="modal-text"><h4>Error</h4><p>' . $error . '</p>'
                 . '</div></div>';
    $tipo = 'danger';
    $icono = '';
    $footer = '<div class="row"><div class="col-md-12 text-right"><button class="btn btn-danger modal-dismiss">OK</button></div></div>';
    echo genera_panel('Acción enviada', '', '', $contenido, $footer, $tipo, $icono);

    echo '</div>';
}
