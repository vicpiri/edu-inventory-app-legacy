<!-- Modals -->
<div id="modalArticuloExiste" class="modal-block modal-block-warning mfp-hide">
        <section class="panel">
                <header class="panel-heading">
                        <h2 class="panel-title">¡Error!</h2>
                </header>
                <div class="panel-body">
                        <div class="modal-wrapper">
                                <div class="modal-icon">
                                        <i class="fa fa-warning"></i>
                                </div>
                                <div class="modal-text">
                                        <h4>El artículo ya existe</h4>
                                        <p>El código de artículo que ha utilizado ya existe en la base de datos. Por favor, para actualizar la información del artículo
                                        utilice la opción 'Editar Artículo' del menú de administración.</p>
                                </div>
                        </div>
                </div>
                <footer class="panel-footer">
                        <div class="row">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-warning modal-dismiss">OK</button>
                                </div>
                        </div>
                </footer>
        </section>
</div>

<div id="modalErrorDB" class="modal-block modal-block-warning mfp-hide">
        <section class="panel">
                <header class="panel-heading">
                        <h2 class="panel-title">¡Error!</h2>
                </header>
                <div class="panel-body">
                        <div class="modal-wrapper">
                                <div class="modal-icon">
                                        <i class="fa fa-warning"></i>
                                </div>
                                <div class="modal-text">
                                        <h4>Error en la base de datos</h4>
                                        <p>Ha ocurrido un error en la base de datos cuando se intentaba guardar el artículo.
                                        Por favor, póngase en contacto con el administrador del sistema y comunique el problema.</p>
                                </div>
                        </div>
                </div>
                <footer class="panel-footer">
                        <div class="row">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-warning modal-dismiss">OK</button>
                                </div>
                        </div>
                </footer>
        </section>
</div>

<div id="modalArticuloGuardado" class="modal-block modal-block-success mfp-hide">
        <section class="panel">
                <header class="panel-heading">
                        <h2 class="panel-title">¡Guardado!</h2>
                </header>
                <div class="panel-body">
                        <div class="modal-wrapper">
                                <div class="modal-icon">
                                        <i class="fa fa-check"></i>
                                </div>
                                <div class="modal-text">
                                        <h4>El artículo ha sido guardado</h4>
                                        <p></p>
                                </div>
                        </div>
                </div>
                <footer class="panel-footer">
                        <div class="row">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-success modal-dismiss">OK</button>
                                </div>
                        </div>
                </footer>
        </section>
</div>

<!-- Fin de Modals -->

<section class="panel-primary">
    <header class="panel-heading">
            <div class="panel-actions">
                    
            </div>

            <h2 class="panel-title">Crear un artículo nuevo</h2>
    </header>
    <form id="form3" class="form-horizontal form-bordered" method="get">
        <div class="panel-body" id="loadingSpinnerPanel" data-loading-overlay >
       
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="inputCodigo">Código <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input name="codigo" type="text" class="form-control" id="inputCodigo" placeholder="Código de barras" title="Este campo es obligatorio" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="centro">Centro <span class="required">*</span></label>
                        <div class="col-md-9">
                        <select id="centro" name="centro" class="form-control" title="Este campo es obligatorio" required>
                                <option value="">-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="departamento">Departamento <span class="required">*</span></label>
                        <div class="col-md-9">
                        <select id="departamento" name="departamento" class="form-control" title="Este campo es obligatorio" required>
                                <option value="">-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="area">Área <span class="required">*</span></label>
                        <div class="col-md-9">
                        <select id="area" name="area" class="form-control" title="Este campo es obligatorio" required>
                                <option value="">-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="armario">Ubicación <span class="required">*</span></label>
                        <div class="col-md-9">
                        <select id="armario" name="ubicacion" class="form-control" title="Este campo es obligatorio" required>
                                <option value="">-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="inputMarca">Marca</label>
                            <div class="col-md-9">
                                    <input name="marca" type="text" class="form-control" id="inputDefault">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Modelo</label>
                            <div class="col-md-9">
                                    <input name="modelo" type="text" class="form-control" id="inputMarca">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="inputSerie">Número de serie</label>
                            <div class="col-md-9">
                                    <input name="serie" type="text" class="form-control" id="inputSerie">
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="area">Tipo <span class="required">*</span></label>
                        <div class="col-md-9">
                        <select id="tipo" name="tipo" class="form-control" title="Este campo es obligatorio" required>
                                <option value="">-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="textareaDescripcion">Descripción <span class="required">*</span></label>
                            <div class="col-md-9">
                                <textarea name="descripcion" class="form-control" rows="3" id="textareaDescripcion"
                                          data-plugin-textarea-autosize placeholder="Descripción genérica del modelo" title="Este campo es obligatorio" required></textarea>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-9 text-center">
                            <img id="visorimagen" class="img-responsive img-rounded" src="images/No_imagen.jpg">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label">Imagen</label>
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
                            <label class="col-md-3 control-label" for="textareaObservaciones">Observaciones</label>
                            <div class="col-md-9">
                                    <textarea name="observaciones" class="form-control" rows="3" id="textareaObservaciones" data-plugin-textarea-autosize  placeholder="Observaciones sobre esta unidad en concreto"></textarea>
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="inputSuccess">Fungible</label>
                            <div class="col-md-6">
                                    <div class="radio">
                                            <label>
                                                    <input type="radio" name="fungible" id="optionsRadios1" value="0" checked="">
                                                    No
                                            </label>
                                    </div>
                                    <div class="radio">
                                            <label>
                                                    <input type="radio" name="fungible" id="optionsRadios2" value="1">
                                                    Sí
                                            </label>
                                    </div>

                            </div>
                    </div>
                </div>
            
            <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
                    
            
    </div>
    <div class="panel-footer text-right">
        <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
        </div>
            
    </div>
</form>
</section>


<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script>
//Inicializamos el contenido de los Select
$("#centro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
$("#centro").change(function(){
    $("#departamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php", $("#form3").serializeArray());
});
$("#departamento").change(function(){
    $("#area").load("code/accion_administracion_nuevo_articulo_rellena_areas.php", $("#form3").serializeArray());
});    
$("#area").change(function(){
    $("#armario").load("code/accion_administracion_nuevo_articulo_rellena_armarios.php", $("#form3").serializeArray());
});

$("#tipo").load("code/accion_administracion_nuevo_articulo_rellena_tipos.php");


//Controlamos que cada vez que seleccionemos una imagen, esta se muestre en el visor
$("#imagen").change(function(event){
    if($("#imagen").val() === ''){
        $('#visorimagen').fadeIn("fast").attr('src','images/No_imagen.jpg');
    }else{
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#visorimagen").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    }    
});

////BLOQUE DE VALIDACIÓN Y ENVÍO DE FORMULARIO

var formID = '#form3'; //id del formulario que vamos a enviar
var urlDestino ='code/accion_administracion_nuevo_articulo_submit.php'; //url del archivo que soportará la recepción de la info
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
            startSpinner();

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
                    console.log('ERRORS: ' + textStatus);
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
                                    
                            }
                            else
                            {
                                    // Handle errors here
                                    alert('error formulario');
                                    console.log('ERRORS: ' + data.error);
                                    notification('error', 'Error al enviar el formulario', data.error, 'fa fa-exclamation');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            // Handle errors here
                            console.log('ERRORS: ' + textStatus);
                            notification('error', 'Enviar el formulario', textStatus, 'fa fa-exclamation');
                        },
                        complete: function()
                        {
                            // STOP LOADING SPINNER
                            stopSpinner();
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
