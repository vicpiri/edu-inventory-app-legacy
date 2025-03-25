<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

$error = '';
if (isset($_POST['centro'])) {
    $centro = $_POST['centro'];
    $sql = "SELECT * FROM centros WHERE id = $centro";
    $row = consultaDB($sql, $db);
    if (count($row) < 1) {
        $error = 'No se encuentra el centro seleccionado en la base de datos.';
    }
} else {
    $error = 'Se ha producido un error en la recepción del código de centro.';
}
if ($error === '') {
    ?>

    <div class="col-md-6 col-md-offset-3">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions"></div><h2 class="panel-title">Editar Centro</h2>
                <p class="panel-subtitle">Realice las modificaciones necesarias y presione 'Guardar'</p>
                <div class="panel-actions">
                    <a href="#" class="panel-action glyphicon glyphicon-trash" id="borrar"></a>
                </div>

            </header>
            <div class="panel-body">
                <form id="formCentro" onsubmit='return false'class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label text-right" for="inputHelpText">Código Centro<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="codigo" name="codigo" required title="Este campo es obligatorio">
                            <span class="help-block">Introduzca el código de centro asignado por la administración.</span>
                        </div>

                        <label class="col-md-3 control-label text-right">Nombre<span class="required">*</span></label>
                        <div class="col-md-9 mb-md">

                            <input type="text" id="nombre" class="form-control" name="nombre" required title="Este campo es obligatorio">
                            <input type="hidden" id="id" class="form-control" name="id">

                        </div>
                    </div>
                </form>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a class="text-muted text-uppercase" href="#" id="botonCentrosRegistrados">(ver centros registrados)</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" id="centroGuardar">Guardar</button>
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
    $('#botonCentrosRegistrados').click(function () { //Inicializamos el Lightbox cada vez que cambia el contenido del input
        enviaLightbox('', 'code/accion_administracion_nuevo_ubicacion_TMP_centros_registrados.php');
    });
    
    $('#borrar').click(function () {
        enviaLightbox($("#formCentro").serialize(), 'code/accion_administracion_editar_ubicacion_centro_borrar.php');
    });
    $('#codigo').val('<?php echo $row['codigo']; ?>');
    $('#nombre').val('<?php echo $row['nombre']; ?>');
    $('#id').val('<?php echo $row['id']; ?>');
    $('#centroGuardar').click(function () {
        if ($('#formCentro').valid()) {
            //$('#subframe').load('code/accion_administracion_editar_ubicacion_centro_guardar.php', $('#formCentro').serializeArray());
            enviaLightbox($("#formCentro").serialize(), 'code/accion_administracion_editar_ubicacion_centro_guardar.php');
        }
    });
</script>

