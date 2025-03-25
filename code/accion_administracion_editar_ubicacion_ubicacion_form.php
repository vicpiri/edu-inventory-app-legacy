<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';
require_once $baseURL . 'code/main_functions.php';

$error = '';
if (isset($_POST['departamento'])) {
    $centro = $_POST['centro'];
    $departamento = $_POST['departamento'];
    $area = $_POST['area'];
    $armario = $_POST['ubicacion'];
    $sql = "SELECT * FROM armarios WHERE id_armario = $armario";
    $row = consultaDB($sql, $db);
    if (count($row) < 1) {
        $error = 'No se encuentra la ubicación seleccionada en la base de datos.';
    }
    
    $plano = $row['plano'];
} else {
    $error = 'Se ha producido un error en la recepción del código de la ubicación.';
}
if ($error === '') {
    ?>

        <div class="col-md-6 col-md-offset-3">
        <section class="panel panel-primary">
            <form id="formUbicacion" onsubmit='return false' class="form-horizontal form-bordered">
            <header class="panel-heading">
                <div class="panel-actions"></div><h2 class="panel-title">Editar Ubicación</h2>
                <p class="panel-subtitle">Realice las modificaciones necesarias y presione 'Guardar'</p>
                <div class="panel-actions">
                    <a href="#" class="panel-action glyphicon glyphicon-trash" id="borrar"></a>
                </div>

            </header>
            <div class="panel-body">
                <form id="formUbicacion" onsubmit='return false'class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
                        <div class="col-md-9 mb-md">
                            <select id="ubiCentro" name="centro" class="form-control" required title="Este campo es obligatorio" disabled>
                                <option>-</option>
                            </select>
                        </div>
                        <label class="col-md-3 control-label text-right" for="ubiDepartamento">Departam.<span class="required">*</span></label>
                        <div class="col-md-9 mb-md">
                            <select id="ubiDepartamento" name="departamento" class="form-control" required title="Este campo es obligatorio" disabled>
                                <option>-</option>
                            </select>
                        </div>

                        <label class="col-md-3 control-label text-right" for="ubiArea">Área<span class="required">*</span></label>
                        <div class="col-md-9 mb-md">
                            <select id="ubiArea" name="area" class="form-control" required title="Este campo es obligatorio">
                                <option>-</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label text-right" for="ubiArmario">Código<span class="required">*</span></label>
                        <div class="col-md-9 mb-md">
                            <input type="text" class="form-control" name="armario" id="ubiArmario" required title="Este campo es obligatorio">
                        </div>

                        <label class="col-md-3 control-label text-right" for="ubiNombre">Descripción<span class="required">*</span></label>
                        <div class="col-md-9 mb-md">  
                            <input type="text" class="form-control" name="nombre" id="ubiNombre" required title="Este campo es obligatorio">
                            <input type="hidden" class="form-control" name="id_armario" id="idArmario">
                        </div>
                        
                    </div>
                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" for="ubiPlano">Plano</label>
                        <div class="col-md-10 mb-md">
                            <div class="fileupload fileupload-new" data-provides="fileupload" id="ubiPlano">
                                <div class="input-append">
                                    <div class="uneditable-input">
                                        <i class="fa fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileupload-exists">Cambiar</span>
                                        <span class="fileupload-new">Selecciona imagen</span>
                                        <input type="file" id="imagen" name="plano">
                                        <input type="hidden" id="imagen_hidden" name="planohidden">
                                    </span>
                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Borrar</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-md center" id="contenedorvisor">
                            <img id="visorimagen" class="img-responsive img-rounded">
                        </div>
                        
                    </div>
               
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-9">
                        <a class="text-muted text-uppercase" href="#" id="botonUbicacionesRegistradas">(ver ubicaciones registradas)</a>
                    </div>
                    <div class="col-md-3 text-right">
                        <button type="submit" class="btn btn-primary" id="centroGuardar">Guardar</button>
                    </div>
                </div>
            </footer>
                 </form>
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
    $('#botonUbicacionesRegistradas').click(function(){
        enviaLightbox($("#formUbicacion").serialize(), 'code/accion_administracion_nuevo_ubicacion_TMP_ubicaciones_registradas.php');
    });
    $("#ubiCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php?centro=<?php echo $centro ?>");
    $("#ubiDepartamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php?centro=<?php echo $centro ?>&departamento=<?php echo $departamento ?>");
    $("#ubiArea").load("code/accion_administracion_nuevo_articulo_rellena_areas.php?departamento=<?php echo $departamento ?>&area=<?php echo $area ?>");
    $("#contenedorvisor").load("code/accion_administracion_nuevo_ubicacion_rellena_plano.php?plano=<?php echo $plano ?>");
    $('#borrar').click(function () {
        enviaLightbox($("#formUbicacion").serialize(), 'code/accion_administracion_editar_ubicacion_ubicacion_borrar.php');
    });
    $('#ubiArmario').val('<?php echo $row['armario']; ?>');
    $('#ubiNombre').val('<?php echo $row['descripcion']; ?>');
    $('#idArmario').val('<?php echo $row['id_armario']; ?>');
    $('#imagen_hidden').val('<?php echo $row['plano']; ?>');
//    $('#centroGuardar').click(function () {
//        if ($('#formCentro').valid()) {
//            //$('#subframe').load('code/accion_administracion_editar_ubicacion_centro_guardar.php', $('#formCentro').serializeArray());
//            enviaLightbox($("#formCentro").serialize(), 'code/accion_administracion_editar_ubicacion_centro_guardar.php');
//        }
//    });
    
    //Controlamos que cada vez que seleccionemos una imagen, esta se muestre en el visor
    $("#imagen").change(function(event){
        if($("#imagen").val() === ''){
            $('#visorimagen').fadeIn("fast").attr('src','userimages/no_imagen.jpg');
        }else{
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#visorimagen").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        }    
    });
    
    ////BLOQUE DE VALIDACIÓN Y ENVÍO DE FORMULARIO

var formID = '#formUbicacion'; //id del formulario que vamos a enviar
var urlDestino ='code/accion_administracion_editar_ubicacion_ubicacion_guardar.php'; //url del archivo que soportará la recepción de la info
//var urlDestino ='submit.php';
//Validamos el formulario
(function() {

	'use strict';

	// basic
	$(formID).validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		}
	});


}).apply( this, [ jQuery ]);
    //Gestionamos la subida del archivo
$(function()
{
        // Variable en la que gaurdaremos los archivos
        var files = 0;

        // Añadimos manejadores de eventos para fileChange y submit
        $('input[type=file]').on('change', prepareUpload); //Cuando cambiamos los archivos, preparamos la subida
        $(formID).on('submit', checkValidation);//Cuando Submit, validamos el formulario
        
        function checkValidation(event){
            if ($(formID).valid()){ //Si el formulario es válido, realizamos la subida
                $("#boton").html('<div class="loading-overlay-showing" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }" >' + 
                                    '<div class="loading-overlay" style="border-radius: 0px 0px 5px 5px;">' + 
                                    '<div class="loader white"></div></div>');
                uploadFiles(event);
            }
        }

        // Grab the files and set them to our variable
        function prepareUpload(event)
        {
            //guardamos en la variable los archivos indicado en el input
                files = event.target.files;
        }

        // Catch the form submit and upload the files
        function uploadFiles(event)
        {
           
            event.stopPropagation(); // Paramos cualquier acción que se realice por defecto
            event.preventDefault(); // Paramos cualquier acción que se realice por defecto
            
            //Comprobamos si se ha indicado algún archivo
            if (files.length > 0){
            
            // MOSTRAR AQUÍ EL SPINNER O LABEL DE SUBIDA
            //
            //startSpinner();
            //console.log('startSpinner');

            // Creamos el objeto FormData y añadimos los archivos
            var data = new FormData();
            $.each(files, function(key, value)
            {
                    data.append(key, value);
            });

            //Establecemos la comunicación con el servidor e intentamos subir el archivo
            $.ajax({
                url: urlDestino+'?files',
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function(data, textStatus, jqXHR)
                {
                    if(typeof data.error === 'undefined')
                    {
                            // Si la subida tiene éxito, procesamos el resto del formulario
                            //alert('exito archivos');
                            
                            submitForm(event, data);
                    }
                    else
                    {
                            // Manejamos los errores
                            alert('error archivos');
                            console.log('ERRORS: ' + data.error);
                            notification('error', 'Error al subir el archivo - success', data.error, 'fa fa-exclamation');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    alert('error de comunicación');
                    console.log('ERRORS: textstatus-' + textStatus + ' \njqXHR-' +jqXHR + ' \nerrorThrown-' + errorThrown);
                    // STOP LOADING SPINNER
                    stopSpinner();
                    notification('error', 'Error al subir el archivo - error', textStatus + ' - ' + errorThrown, 'fa fa-exclamation');
                }

            });
        }else{
            var data = new FormData();
            submitForm(event, data);
        }
    }
    
    function submitForm(event, data)
        {
                // Create a jQuery object from the form
                $form = $(event.target);
		
                // Serialize the form data
                var formData = $form.serialize();
		
                // You should sterilise the file names
                if(typeof data.files === 'undefined'){
                    
                }else{
                    $.each(data.files, function(key, value)
                    {
                            formData = formData + '&filenames[]=' + value;
                    });
                }

                
                
                $.ajax({
                        url: urlDestino,
                        type: 'POST',
                        data: formData,
                cache: false,
                dataType: 'html',
                success: function (data, textStatus, jqXHR)
                {
                    //alert('respuesta recibida');
                    if (typeof data.error === 'undefined')
                    {

                        // Success so call function to process the form
                        console.log('SUCCESS: ' + data.success);

                        if (data.replace(/\W/g, '') === 'errorExiste') {
                            $.magnificPopup.open({
                                items: {
                                    src: '#modalArticuloExiste'
                                },
                                type: 'inline',
                                preloader: false,
                                modal: true
                            }, 0);
                        } else if (data.replace(/\W/g, '') === 'errorDB') {
                            $.magnificPopup.open({
                                items: {
                                    src: '#modalErrorDB'
                                },
                                type: 'inline',
                                preloader: false,
                                modal: true
                            }, 0);
                        } else {
                            $('#subframe').html(data);
                        }

                        //notification('success', 'Formulario Enviado', data.error, 'fa fa-check');
                        stopSpinner();
                    } else
                    {
                        // Handle errors here
                        alert('error formulario');
                        console.log('ERRORS: ' + data.error);
                        notification('error', 'Error al enviar el formulario', data.error, 'fa fa-exclamation');
                        stopSpinner();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    notification('error', 'Enviar el formulario', textStatus, 'fa fa-exclamation');
                    stopSpinner();
                },
                complete: function ()
                {
                    // STOP LOADING SPINNER
                    stopSpinner();
                    //console.log('stopspinner');
                }
            });
        }

        function startSpinner() {
            $('#loadingSpinnerPanel').trigger('loading-overlay:show');
        }

        function stopSpinner() {
            $('#loadingSpinnerPanel').trigger('loading-overlay:hide');
        }
    });
</script>

