<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$error = '';
if (isset($_GET['id'])){
    $idCentro = $_GET['centro'];
    $abreviaturaDepartamento = $_GET['abreviatura'];
    $nombreDepartamento = $_GET['nombre'];
    $idDepartamento = $_GET['id'];

//Buscamos si ya existe en la base de datos
    $sql = "SELECT * FROM departamentos WHERE centro = $idCentro AND abreviatura"
            . " LIKE '$abreviaturaDepartamento' AND not id_departamento = $idDepartamento";
    
    $rowsCentros = consultaDB_ALL($sql, $db);
    
    if (count($rowsCentros) > 0){
        $error = 'El código del departamento ya existe para este centro en la base de datos.';
    }else{
        //Guardamos la información del formulario en la base de datos
        
        $sql = "UPDATE departamentos SET centro = $idCentro, abreviatura = '$abreviaturaDepartamento',"
                . " descripcion = '$nombreDepartamento' WHERE id_departamento = $idDepartamento";
        
        consultaDB($sql, $db);
        
        $sql = "SELECT * FROM departamentos WHERE id_departamento = $idDepartamento"
                . " AND abreviatura LIKE '$abreviaturaDepartamento' AND descripcion = '$nombreDepartamento'";

        $rowsDepartamentos = consultaDB_ALL($sql, $db);

        if (count($rowsDepartamentos) < 1){
            $error = 'Se ha producido un error en la almacenando en la base de datos ' .$sql;
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
    $footer = '<div class="row"><div class="col-md-12 text-right"><button id="ok" class="btn btn-success modal-reload-admin-edit-ubic">OK</button></div></div>';
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
