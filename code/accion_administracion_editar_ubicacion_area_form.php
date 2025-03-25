<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

$error = '';
if (isset($_POST['departamento'])) {
    $centro = $_POST['centro'];
    $departamento = $_POST['departamento'];
    $area = $_POST['area'];
    $sql = "SELECT * FROM areas WHERE id_area = $area";
    $row = consultaDB($sql, $db);
    if (count($row) < 1) {
        $error = 'No se encuentra el área seleccionada en la base de datos.';
    }
} else {
    $error = 'Se ha producido un error en la recepción del código del área.';
}
if ($error === '') {
    ?>

    <div class="col-md-6 col-md-offset-3">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions"></div><h2 class="panel-title">Editar Area</h2>
                <p class="panel-subtitle">Realice las modificaciones necesarias y presione 'Guardar'</p>
                <div class="panel-actions">
                    <a href="#" class="panel-action glyphicon glyphicon-trash" id="borrar"></a>
                </div>

            </header>
            <div class="panel-body">
                <form id="formArea" onsubmit='return false'class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
                            <div class="col-md-9 mb-md">
                                <select id="areCentro" name="centro" class="form-control" required title="Este campo es obligatorio" disabled>
                                    <option>-</option>
                                </select>
                            </div>

                            <label class="col-md-3 control-label text-right" for="departamento">Departamento<span class="required">*</span></label>
                            <div class="col-md-9 mb-md">
                                <select id="areDepartamento" name="departamento" class="form-control" required title="Este campo es obligatorio">
                                    <option>-</option>
                                </select>
                            </div>

                            <label class="col-md-3 control-label" for="area">Área<span class="required">*</span></label>
                            <div class="col-md-9 mb-md">
                                <input type="text" class="form-control" id="area" name="area" required title="Este campo es obligatorio">
                                <input type="hidden" class="form-control" id="idArea" name="idArea" >
                            </div>
                        </div>
                    </form>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a class="text-muted text-uppercase" href="#" id="botonAreasRegistradas">(ver áreas registradas)</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" id="areaGuardar">Guardar</button>
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
    $('#botonAreasRegistradas').click(function () { //Inicializamos el Lightbox cada vez que cambia el contenido del input
        enviaLightbox($("#formArea").serialize(), 'code/accion_administracion_nuevo_ubicacion_TMP_areas_registradas.php');
    });
    $("#areCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php?centro=<?php echo $centro ?>");
    $("#areDepartamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php?centro=<?php echo $centro ?>&departamento=<?php echo $departamento ?>");
    $('#borrar').click(function () {
        enviaLightbox($("#formArea").serialize(), 'code/accion_administracion_editar_ubicacion_area_borrar.php');
    });
    $('#area').val('<?php echo $row['nombre']; ?>');
    $('#idArea').val('<?php echo $row['id_area']; ?>');
    $('#areaGuardar').click(function () {
        if ($('#formArea').valid()) {
            //$('#subframe').load('code/accion_administracion_editar_ubicacion_centro_guardar.php', $('#formCentro').serializeArray());
            enviaLightbox($("#formArea").serialize(), 'code/accion_administracion_editar_ubicacion_area_guardar.php');
        }
    });
</script>

