<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<section class="panel-primary">
    <header class="panel-heading">
            <div class="panel-actions">
                    
            </div>

            <h2 class="panel-title">Crear nuevo usuario</h2>
    </header>
    <form id="form3" class="form-horizontal form-bordered" method="get">
        <div class="panel-body" id="loadingSpinnerPanel" data-loading-overlay >
       
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="username">Username <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input name="username" type="text" class="form-control" id="inputUsername" title="Este campo es obligatorio" required>
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="nombre">Nombre <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input name="nombre" type="text" class="form-control" id="inputNombre" title="Este campo es obligatorio" required>
                            </div>
                    </div>
                    
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="apellido1">Primer Apellido <span class="required">*</span></label>
                            <div class="col-md-9">
                                    <input name="apellido1" type="text" class="form-control" id="inputApellido1" title="Este campo es obligatorio" required>
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="apellido2">Segundo Apellido</label>
                            <div class="col-md-9">
                                    <input name="apellido2" type="text" class="form-control" id="inputApellido2">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="mail">Correo electrónico</label>
                            <div class="col-md-9">
                                    <input name="mail" type="email" class="form-control" id="inputMail" title="Introduzca una email válido">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="fechanacimiento">Fecha de nacimiento<span class="required">*</span></label>
                            <div class="col-md-9">
                                <input name="fechanacimiento" type="text" class="form-control" id="inputFechaNacimiento" placeholder="00-00-0000" title="Este campo es obligatorio" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="tipo">Nivel de seguridad <span class="required">*</span></label>
                        <div class="col-md-9">
                        <select id="tipo" name="tipo" class="form-control" title="Este campo es obligatorio" required>
                                <option value="">-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="telefono">Teléfono 1</label>
                            <div class="col-md-9">
                                    <input name="telefono" type="text" class="form-control" id="inputTelefono1">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="telefono2">Teléfono 2</label>
                            <div class="col-md-9">
                                    <input name="telefono2" type="text" class="form-control" id="inputTelefono2">
                            </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-9 text-center" id="contenedorvisor">
                            <img id="visorimagen" class="img-responsive img-rounded" src="userimages/no_imagen.jpg">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label">Fotografía</label>
                            <div class="col-md-9">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                    <div class="uneditable-input">
                                                            <i class="fa fa-file fileupload-exists"></i>
                                                            <span class="fileupload-preview"></span>
                                                    </div>
                                                    <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists">Cambiar</span>
                                                            <span class="fileupload-new">Seleccionar archivo</span>
                                                            <input name="imagen" type="file" id="imagen" />
                                                    </span>
                                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="password">Password<span class="required">*</span></label>
                            <div class="col-md-9">
                                <input name="password" type="password" class="form-control" id="inputPass" required title="Este campo es obligatorio">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="passwordconfirm">Confirmar Password</label>
                            <div class="col-md-9">
                                    <input name="passwordconfirm" type="password" class="form-control" id="inputPassConfirm" equalTo="#inputPass" title="La contraseña no coincide">
                            </div>
                    </div>
                    
                </div>
                        
    </div>
    <div class="panel-footer text-right">
        <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary" ><i class="fa fa-save" id="boton"></i> Guardar</button>
                </div>
        </div>
            
    </div>
</form>
</section>


<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

<script>
//Inicializamos el contenido de los Select
$("#tipo").load("code/accion_administracion_nuevo_usuario_rellena_tipos.php?userlevel=<?php echo $_SESSION['userlevel']; ?>");

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

var formID = '#form3'; //id del formulario que vamos a enviar
var urlDestino ='code/accion_administracion_nuevo_usuario_submit.php'; //url del archivo que soportará la recepción de la info
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
                        success: function(data, textStatus, jqXHR)
                        {
                            //alert('respuesta recibida');
                            if(typeof data.error === 'undefined')
                            {
                                    
                                    // Success so call function to process the form
                                    console.log('SUCCESS: ' + data.success);
                                    
                                    if (data.replace(/\W/g, '') === 'errorExiste'){
                                        $.magnificPopup.open({
                                            items: {
                                                src: '#modalArticuloExiste'
                                            },
                                            type: 'inline',
                                            preloader: false,
                                            modal: true
                                        }, 0);
                                    }else if (data.replace(/\W/g, '') === 'errorDB'){
                                        $.magnificPopup.open({
                                            items: {
                                                src: '#modalErrorDB'
                                            },
                                            type: 'inline',
                                            preloader: false,
                                            modal: true
                                        }, 0);
                                    }else{
                                        $('#subframe').html(data);
                                    }
                                    
                                    //notification('success', 'Formulario Enviado', data.error, 'fa fa-check');
                                    stopSpinner();
                            }
                            else
                            {
                                    // Handle errors here
                                    alert('error formulario');
                                    console.log('ERRORS: ' + data.error);
                                    notification('error', 'Error al enviar el formulario', data.error, 'fa fa-exclamation');
                                    stopSpinner();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            // Handle errors here
                            console.log('ERRORS: ' + textStatus);
                            notification('error', 'Enviar el formulario', textStatus, 'fa fa-exclamation');
                            stopSpinner();
                        },
                        complete: function()
                        {
                            // STOP LOADING SPINNER
                            stopSpinner();
                            //console.log('stopspinner');
                        }
		});
	}
        
        function startSpinner(){
            $('#loadingSpinnerPanel').trigger('loading-overlay:show');
        }
        
        function stopSpinner(){
            $('#loadingSpinnerPanel').trigger('loading-overlay:hide');
        }
});

////FIN DEL BLOQUE DE VALIDACIÓN Y ENVÍO DE FORMULARIO
</script>
