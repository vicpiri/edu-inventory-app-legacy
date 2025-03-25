<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$error = '';
if (isset($_GET['nombre'])){
    $nombreDepartamento = $_GET['nombre'];
    $nombreAbreviatura = $_GET['abreviatura'];
    $codigoCentro = $_GET['centro'];
    
//Buscamos si ya existe en la base de datos
    $sql = "SELECT * FROM departamentos WHERE centro = $codigoCentro AND abreviatura LIKE '$nombreAbreviatura'";
    
    $rows = consultaDB_ALL($sql, $db);
    
    if (count($rows) > 0){
        $error = 'La abreviatura ya existe para este centro.';
    }else{
        //Guardamos la información del formulario en la base de datos
        $sql = "INSERT INTO departamentos (centro, abreviatura, descripcion) VALUES ($codigoCentro, '$nombreAbreviatura', '$nombreDepartamento')";
        
        consultaDB($sql, $db);
        
        $sql = "SELECT * FROM departamentos WHERE centro = $codigoCentro AND abreviatura LIKE '$nombreAbreviatura'";

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
