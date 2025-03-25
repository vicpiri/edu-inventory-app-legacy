<!-- Modals -->
<div id="modalSuccess" class="modal-block modal-block-success mfp-hide">
        <section class="panel">
                <header class="panel-heading">
                        <h2 class="panel-title">Guardado</h2>
                </header>
                <div class="panel-body">
                        <div class="modal-wrapper">
                                <div class="modal-icon">
                                        <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="modal-text">
                                        <h4>Ubicación guardada</h4>
                                        <p>La ubicación ha sido guardada correctamente.</p>
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

<div id="modalErrorCom" class="modal-block modal-block-danger mfp-hide">
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
                                        <h4>Error en la comunicación</h4>
                                        <p>Parece que ha habido un problema enviando la información al servidor.
                                        Por favor, vuelva a intentarlo o contacte con el administrador.</p>
                                </div>
                        </div>
                </div>
                <footer class="panel-footer">
                        <div class="row">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-danger modal-dismiss">OK</button>
                                </div>
                        </div>
                </footer>
        </section>
</div>

<div id="modalErrorDB" class="modal-block modal-block-danger mfp-hide">
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
                                        <p>Ha ocurrido un error en la base de datos cuando se intentaba guardar el la ubicación.
                                        Por favor, póngase en contacto con el administrador del sistema y comunique el problema.</p>
                                </div>
                        </div>
                </div>
                <footer class="panel-footer">
                        <div class="row">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-danger modal-dismiss">OK</button>
                                </div>
                        </div>
                </footer>
        </section>
</div>

<div id="modalErrorUbicacion" class="modal-block modal-block-danger mfp-hide">
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
                                        <h4>No se ha podido guardar la ubicación</h4>
                                        <p>No se ha podido guardar la ubicación porque ya existe ese
                                        código para el área seleccionada.</p>
                                </div>
                        </div>
                </div>
                <footer class="panel-footer">
                        <div class="row">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-danger modal-dismiss">OK</button>
                                </div>
                        </div>
                </footer>
        </section>
</div>

<!-- Fin de Modals -->
<form id="formUbicacion" onsubmit='return false' class="form-horizontal form-bordered">
    <div class="form-group">
        <label class="col-md-3 control-label text-right" for="ubiCentro">Centro<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
        <select id="ubiCentro" name="centro" class="form-control" required title="Este campo es obligatorio">
                <option>-</option>
        </select>
        </div>
    
        <label class="col-md-3 control-label text-right" for="ubiDepartamento">Departam.<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
        <select id="ubiDepartamento" name="departamento" class="form-control" required title="Este campo es obligatorio">
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

            <div class="col-md-12 mb-md center" id="contenedorvisor">
                <img id="visorimagen" class="img-responsive img-rounded">
            </div>
                        
        <label class="col-md-2 control-label" for="ubiPlano">Plano</label>
            <div class="col-md-10 mb-md fileupload fileupload-new" data-provides="fileupload" id="ubiPlano">
                <div class="input-append">
                    <div class="uneditable-input">
                        <i class="fa fa-file fileupload-exists"></i>
                        <span class="fileupload-preview"></span>
                    </div>
                    <span class="btn btn-default btn-file">
                        <span class="fileupload-exists">Cambiar</span>
                        <span class="fileupload-new">Selecciona imagen</span>
                        <input type="file" id="imagen" name="plano">
                    </span>
                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Borrar</a>
                </div>
            </div>
            
            <label class="col-md-3 control-label text-right" for="ubiAbreviatura">Código<span class="required">*</span></label>
            <div class="col-md-9 mb-md">
                <input type="text" class="form-control" name="abreviatura" id="ubiAbreviatura" required title="Este campo es obligatorio">
            </div>
            
       
            <label class="col-md-3 control-label text-right" for="ubiNombre">Descripción<span class="required">*</span></label>
            <div class="col-md-9">
                    <div class="input-group mb-md">
                        <input type="text" class="form-control" name="nombre" id="ubiNombre" required title="Este campo es obligatorio">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" id="ubicacionGuardar">Guardar</button>
                            </span>
                    </div>
            </div>
            <div class="text-right col-md-12">
                 <a class="text-muted text-uppercase" href="#" id="botonUbicacionesRegistradas">(ver ubicaciones registradas)</a>
            </div>
    </div>
</form>

<script>
    $("#ubiCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
    $('#botonUbicacionesRegistradas').click(function(){
        enviaLightbox($("#formUbicacion").serialize(), 'code/accion_administracion_nuevo_ubicacion_TMP_ubicaciones_registradas.php');
    });
    $("#ubiCentro").change(function(){
        $("#ubiDepartamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php", $("#formUbicacion").serializeArray());
    });
    $("#ubiDepartamento").change(function(){
        $("#ubiArea").load("code/accion_administracion_nuevo_articulo_rellena_areas.php", $("#formUbicacion").serializeArray());
    });    
    $("#ubiArea").change(function(){
        $("#armario").load("code/accion_administracion_nuevo_articulo_rellena_armarios.php", $("#formUbicacion").serializeArray());
    });
    
     //Controlamos que cada vez que seleccionemos una imagen, esta se muestre en el visor
    $("#imagen").change(function(event){
        if($("#imagen").val() === ''){
            $('#visorimagen').fadeIn("fast").attr('src','');
        }else{
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#visorimagen").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        }    
    });
    
    var formID = '#formUbicacion'; //id del formulario que vamos a enviar
    var urlDestino ='code/accion_administracion_nuevo_ubicacion_guardar_ubicacion.php'; //url del archivo que soportará la recepción de la info
    (function() {

            'use strict';

            // basic
            $('#formUbicacion').validate({
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
        // Variable en la que guardaremos los archivos
        var files = 0;

        // Añadimos manejadores de eventos para fileChange y submit
        $('input[type=file]').on('change', prepareUpload); //Cuando cambiamos los archivos, preparamos la subida
        $(formID).on('submit', checkValidation);//Cuando Submit, validamos el formulario
//        $('#ubicacionGuardar').on('click', checkValidation);//Cuando Submit, validamos el formulario
//        $('#ubicacionGuardar').click(function(){
//            checkValidation;
//        });
        
        function checkValidation(event){
            //console.log('Validation');
            if ($(formID).valid()){ //Si el formulario es válido, realizamos la subida
               
                uploadFiles(event);
            }
        }

        // Grab the files and set them to our variable
        function prepareUpload(event)
        {
            //guardamos en la variable los archivos indicados en el input
                files = event.target.files;
                console.log('Prepare');
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
                    console.log('Upload ' + files.length);    
                    data.append(key, value);
                });
                //console.log(data);
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
                //console.log('Entrada Submitform');
		
                // Serialize the form data
                var formData = $form.serialize();
		//console.log(data);
                // You should sterilise the file names
                if(typeof data.files === 'undefined'){
                    
                }else{
                    $.each(data.files, function(key, value)
                    {
                            formData = formData + '&filenames[]=' + value;
                            //formdata.append('filename', value);
                            //console.log('hola');
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
                                    src: '#modalErrorUbicacion'
                                },
                                type: 'inline',
                                preloader: false,
                                modal: true
                            }, 0);
                        } else if (data.replace(/\W/g, '') === 'errorComunicacion') {
                            $.magnificPopup.open({
                                items: {
                                    src: '#modalErrorCom'
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
                        } else{
                            $.magnificPopup.open({
                                items: {
                                    src: '#modalSuccess'
                                },
                                type: 'inline',
                                preloader: false,
                                modal: true
                            }, 0);
                            $('#subframe').load('code/accion_administracion_nuevo_ubicacion.php');
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
    
//    $('#ubicacionGuardar').click(function(){
//        if ($('#formUbicacion').valid()){
//            //$('#subframe').load('code/accion_administracion_nuevo_ubicacion_guardar_departamento.php', $('#formDepartamento').serializeArray());
//            enviaLightbox($("#formUbicacion").serialize(), 'code/accion_administracion_nuevo_ubicacion_guardar_ubicacion.php');
//        }
//    });
</script>
