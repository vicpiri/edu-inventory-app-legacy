<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

$error = '';
if (isset($_POST['departamento'])) {
    $centro = $_POST['centro'];
    $departamento = $_POST['departamento'];
    $sql = "SELECT * FROM departamentos WHERE id_departamento = $departamento";
    $row = consultaDB($sql, $db);
    if (count($row) < 1) {
        $error = 'No se encuentra el departamento seleccionado en la base de datos.';
    }
} else {
    $error = 'Se ha producido un error en la recepción del código del departamento.';
}
if ($error === '') {
    ?>

    <div class="col-md-6 col-md-offset-3">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions"></div><h2 class="panel-title">Editar Departamento</h2>
                <p class="panel-subtitle">Realice las modificaciones necesarias y presione 'Guardar'</p>
                <div class="panel-actions">
                    <a href="#" class="panel-action glyphicon glyphicon-trash" id="borrar"></a>
                </div>

            </header>
            <div class="panel-body">
                <form id="formDepartamento" onsubmit='return false'class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
                            <div class="col-md-9 mb-md">
                                <select id="depCentro" name="centro" class="form-control" required title="Este campo es obligatorio">
                                    <option>-</option>
                                </select>
                            </div>

                            <label class="col-md-3 control-label" for="abreviatura">Abreviatura<span class="required">*</span></label>
                            <div class="col-md-9 mb-md">
                                <input type="text" class="form-control" id="abreviatura" name="abreviatura" required title="Este campo es obligatorio">
                            </div>

                            <label class="col-md-3 control-label text-right">Nombre<span class="required">*</span></label>
                            <div class="col-md-9">                     
                                <input type="text" class="form-control" id="nombre" name="nombre" required title="Este campo es obligatorio">
                                <input type="hidden" id="id" class="form-control" name="id">
                            </div>  
                        </div>
                    </form>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a class="text-muted text-uppercase" href="#" id="botonDepartamentosRegistrados">(ver departamentos registrados)</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" id="departamentoGuardar">Guardar</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>

    <?php
} else {
    ?>

    <div class="col-md-6 col-md-offset-3">
        <section class="panel panel-danger">
            <header class="panel-heading">
                <div class="panel-actions"></div><h2 class="panel-title">Error</h2>
                <p class="panel-subtitle"></p>
            </header>
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fa fa-times-circle danger"></i>
                    </div>
                    <div class="modal-text">
                        <h4>¡Atención!</h4>
                        <p><?php echo $error ?></p>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <?php
}
?>
<script>
    $('#botonDepartamentosRegistrados').click(function () { //Inicializamos el Lightbox cada vez que cambia el contenido del input
        enviaLightbox($("#formDepartamento").serialize(), 'code/accion_administracion_nuevo_ubicacion_TMP_departamentos_registrados.php');
    });
    $("#depCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php?centro=<?php echo $centro ?>");
    $('#borrar').click(function () {
        enviaLightbox($("#formDepartamento").serialize(), 'code/accion_administracion_editar_ubicacion_departamento_borrar.php');
    });
    $('#abreviatura').val('<?php echo $row['abreviatura']; ?>');
    $('#nombre').val('<?php echo $row['descripcion']; ?>');
    $('#id').val('<?php echo $row['id_departamento']; ?>');
    $('#departamentoGuardar').click(function () {
        if ($('#formDepartamento').valid()) {
            //$('#subframe').load('code/accion_administracion_editar_ubicacion_centro_guardar.php', $('#formCentro').serializeArray());
            enviaLightbox($("#formDepartamento").serialize(), 'code/accion_administracion_editar_ubicacion_departamento_guardar.php');
        }
    });
</script>

