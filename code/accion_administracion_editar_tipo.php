<?php
//Comprobamos si la página se está cargando con datos ya enviados

if (isset($_POST['nombre'])) {
    require 'config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    if ($_POST['eliminado'] === 'ELIMINAR') { //Comprobamos si la acción a ejecutar es eliminar
        //Comprobamos si existen artículos con dependencias de este tipo
        $sql = "SELECT * FROM articulos WHERE id_tipo=$tipo";
        $rowsArticulos = consultaDB_ALL($sql, $db);

        if (sizeof($rowsArticulos) > 0) { //Si existen, mostramos un mensaje de error
            ?>
            <div id="modalWarning" class="modal-block modal-block-warning mfp-hide">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">¡Atención!</h2>
                    </header>
                    <div class="panel-body">
                        <div class="modal-wrapper">
                            <div class="modal-icon">
                                <i class="fa fa-warning"></i>
                            </div>
                            <div class="modal-text">
                                <h4>No se puede eliminar el tipo</h4>
                                <p>No es posible eliminar el tipo seleccionado porque existen artículos asociados a él.</p>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-warning modal-dismiss">Aceptar</button>
                            </div>
                        </div>
                    </footer>
                </section>
            </div>
            <script>
                $.magnificPopup.open({
                    items: {
                        src: '#modalWarning'
                    },
                    type: 'inline',
                    preloader: false,
                    modal: true
                }, 0);
            </script>
            <?php
        } else { //Si no, eliminamos el tipo
            $sql = "DELETE FROM tipos WHERE id=$tipo";
            consultaDB($sql, $db);
        }
    } else { //Si no eliminamos, entonces editamos
        $sql = "UPDATE tipos SET nombre='$nombre' WHERE id=$tipo";

        consultaDB($sql, $db);
    }
}
?>

<section class="panel-primary">
    <header class="panel-heading">
        <div class="panel-actions">

            <span class="fa-lg">
                <a id="csvdownload" class="fa fa-cloud-download" href="#"></a>
                <script>
                    $('#csvdownload').click(function (e) {
                        e.preventDefault();  //stop the browser from following
                        window.open('<?php echo $baseURLClient ?>code/download_csv_tipos.php');
                    });
                </script>
            </span>

        </div>

        <h2 class="panel-title">Editar un tipo de artículo</h2>
    </header>
    <form id="form3" class="form-horizontal form-bordered">
        <div class="panel-body" data-loading-overlay id="loadingpanel">

            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-md-3 control-label">Selecciona el tipo a editar</label>
                    <div class="col-md-6">
                        <select multiple="" class="form-control" size="20" id="tipo" name="tipo">
                            <option>-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputNombre">Nombre del tipo <span class="required">*</span></label>
                    <div class="col-md-6">
                        <input name="nombre" type="text" class="form-control" id="inputNombre" placeholder="Pon un nombre" title="Este campo es obligatorio" required>
                    </div>
                </div>
            </div>


        </div>
        <div class="panel-footer text-right">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="guardar"><i class="fa fa-save"></i> Guardar</button>
                    <a href="#modalPrimary" class="mb-xs mt-xs mr-xs btn btn-danger modal-basic" id="eliminar"><i class="fa fa-save"></i> Eliminar tipo seleccionado</a>
                    <input type="hidden" id="eliminado" value="NO_ELIMINAR" name="eliminado">
                </div>
                <div class="col-sm-9 col-sm-offset-3">

                </div>
                <div id="modalPrimary" class="modal-block modal-block-primary mfp-hide">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">¿Está seguro?</h2>
                        </header>
                        <div class="panel-body">
                            <div class="modal-wrapper">
                                <div class="modal-icon">
                                    <i class="fa fa-question-circle"></i>
                                </div>
                                <div class="modal-text">
                                    <h4>¿Seguro que quiere eliminar este tipo de archivo?</h4>
                                    <p class="texto-modal">No parece haber seleccionado ningún tipo de artículo. ¿Quiere continuar?</p>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary modal-confirmar">Confirmar</button>
                                    <button class="btn btn-default modal-rechazar">Cancelar</button>
                                </div>
                            </div>
                        </footer>
                    </section>
                </div>
            </div>

        </div>
    </form>
</section>

<script>
//Rellenamos los tipos existentes
    $("#tipo").load("code/accion_administracion_nuevo_tipo_rellena_tipos.php");

    var formID = '#form3';
//var urlDestino ='submit.php';
//Validamos el formulario
    (function () {

        'use strict';

        // basic
        $(formID).validate({
            highlight: function (label) {
                $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (label) {
                $(label).closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                var placement = element.closest('.input-group');
                if (!placement.get(0)) {
                    placement = element;
                }
                if (error.text() !== '') {
                    placement.after(error);
                }
            }
        });

    }).apply(this, [jQuery]);

    $(formID + ' select').change(function (e) {

        //$('#inputNombre').load('code/accion_administracion_editar_tipo_guardar.php', $(formID).serializeArray());
        $('#inputNombre').val($(formID + " select option:selected").text());
        $('.texto-modal').html("Está a punto de eliminar el tipo " + $(formID + " select option:selected").text());

    });

    $('#guardar').click(function () {
        if ($(formID).valid()) {
            $('#subframe').load('code/accion_administracion_editar_tipo.php', $(formID).serializeArray());
        }
    });

    $(formID).submit(function (e) {
        e.preventDefault();
    });

//Mensaje de advertencia de borrado



    /*
     Basic
     */
    $('.modal-basic').magnificPopup({
        type: 'inline',
        preloader: false,
        modal: true
    });

    /* ATENCIÓN NO UTILIZAR LAS FUNCIONES DE LOS EJEMPLOS PORQUE SE PROCUDEN REBOTES
     * ES MEJOR UTILIZAR LA SINTAXIS DE MÁS ABAJO
     /*
     Modal Dismiss
     
     $(document).on('click', '.modal-rechazar', function (e) {
     e.preventDefault();
     $.magnificPopup.close();
     });
     
     
     Modal Confirm
     
     $(document).on('click', '.modal-confirmar', function (e) {
     e.preventDefault();
     $.magnificPopup.close();
     alert('confirmado');
     $('#eliminado').val('ELIMINAR');
     $('#subframe').load('code/accion_administracion_editar_tipo.php', $(formID).serializeArray());
     });*/

    $('.modal-confirmar').click(function (e) {
        e.preventDefault();
        $.magnificPopup.close();
        //alert('confirmado');
        $('#eliminado').val('ELIMINAR');
        $('#subframe').load('code/accion_administracion_editar_tipo.php', $(formID).serializeArray());
    });

    $('.modal-rechazar').click(function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });

</script>
