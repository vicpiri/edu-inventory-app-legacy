<?php
require 'config.php';
require_once 'main_functions.php';
?>

<div class="row">
    <div class="col-xs-12">
        <section class="panel panel-primary form-wizard" id="w4">
            <header class="panel-heading">
                    
                    <h2 class="panel-title">Importar fotografías de los usuarios</h2>
            </header>
            <div class="panel-body" id="loadingSpinnerPanel">
                    <div class="wizard-progress wizard-progress-lg">
                            <div class="steps-progress">
                                    <div class="progress-indicator"></div>
                            </div>
                            <ul class="wizard-steps">
                                    <li class="active">
                                            <a href="#wiz-archivo" data-toggle="tab"><span>1</span>Archivos</a>
                                    </li>
                                    <li>
                                        <a href="#wiz-validacion" data-toggle="tab"><span id="loading2">2</span>Validación</a>
                                    </li>
                                    <li>
                                        <a href="#wiz-guardado" data-toggle="tab"><span id="loading3">3</span>Guardado</a>
                                    </li>
                            </ul>
                    </div>

                
                            <div class="tab-content">
                                
                                    <div id="wiz-archivo" class="tab-pane active">
                                        <?php require $baseURL . 'code/accion_administracion_importar_imagenes_usuarios_archivo_form.php'; ?>
                                        
                                    </div>
                                
                                    <div id="wiz-validacion" class="tab-pane">
                                            
                                    </div>
                                    <div id="wiz-guardado" class="tab-pane">
                                        <?php require $baseURL . 'code/accion_administracion_importar_imagenes_usuarios_guardado.php'; ?>    
                                    </div>
                                    
                            </div>
                    
            </div>
            <div class="panel-footer">
                    <ul class="pager">
                            <li class="previous disabled">
                                    <a><i class="fa fa-angle-left"></i> Anterior</a>
                            </li>
                            <li class="finish hidden pull-right">
                                    <a>Finalizar</a>
                            </li>
                            <li class="next">
                                    <a>Siguiente <i class="fa fa-angle-right"></i></a>
                            </li>
                    </ul>
            </div>
        </section>
    </div>
</div>
<script>
    $(function()
        {
            var formID = '#w4 form'; //id del formulario que vamos a enviar
            var urlDestino ='code/accion_administracion_importar_imagenes_usuarios_submit.php'; //url del archivo que soportará la recepción de la info
            var separadorTipo = ';';
            
            //Manejo del selector de tipos de archivo
            
            $('#tipoarchivo').change(function(event){
                separadorTipo = $('#tipoarchivo').val();
            });
        
            ///VALIDACIÓN DEL FORMULARIO
            var $w4finish = $('#w4').find('ul.pager li.finish'),
                        $w4validator = $("#w4 form").validate({
                        highlight: function(element) {
                                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                        },
                        success: function(element) {
                                $(element).closest('.form-group').removeClass('has-error');
                                $(element).remove();
                        },
                        errorPlacement: function( error, element ) {
                                element.parent().append( error );
                        }
                });

                $w4finish.on('click', function( ev ) {
                        ev.preventDefault();
                        var validated = $('#w4 form').valid();
                        if ( validated ) {
                            $("#loading3").html('<div class="loading-overlay-showing" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }" >' + 
                                    '<div class="loading-overlay" style="border-radius: 0px 0px 5px 5px;">' + 
                                    '<div class="loader black"></div></div>');
                                $.ajax({
                                    type: "POST",
                                    data: {directorio:directorio, 
                                            correctos:correctos, 
                                            errores:errores,
                                            user: '<?php echo $_SESSION['user']; ?>'},
                                    url: "code/accion_administracion_importar_imagenes_usuarios_guardado_submit.php",
                                    success: function(data, textStatus, jqXHR){
                                      
                                      if (data.replace(/\W/g, '') === 'errores'){
                                            $.magnificPopup.open({
                                                items: {
                                                    src: '#modalArticuloErrores'
                                                },
                                                type: 'inline',
                                                preloader: false,
                                                modal: true
                                            }, 0);
                                        }else{
                                            $('#wiz-guardado').html(data);
                                        }
                                    }
                                });
                                $("#zonaForm").html('<div class="panel-body" style="min-height: 150px; position: relative;">' +
                                '<div class="alert alert-warning col-md-6 col-md-offset-3 text-center">' +
                                'Guandando la información en el servidor. Esto puede tardar unos minutos. <br/>Por favor, espere...' +
                                '</div></div>');
                        }
                });

                ///CONTROL DE LA INTERFAZ DEL WIZARD
                $('#w4').bootstrapWizard({
                        tabClass: 'wizard-steps',
                        nextSelector: 'ul.pager li.next',
                        previousSelector: 'ul.pager li.previous',
                        firstSelector: null,
                        lastSelector: null,
                        onNext: function( tab, navigation, index, newindex ) {
                                var validated = $('#w4 form').valid();
                                if( !validated ) {
                                        $w4validator.focusInvalid();
                                        return false;
                                }else{
                                    if (index === 1){
                                        //alert('primero');
                                        //uploadFiles(/*event*/);
                                    }
                                }
                        },
                        onTabClick: function( tab, navigation, index, newindex ) {
                                if ( newindex == index + 1 ) {
                                        return this.onNext( tab, navigation, index, newindex);
                                } else if ( newindex > index + 1 ) {
                                        return false;
                                } else {
                                        return true;
                                }
                        },
                        onTabChange: function( tab, navigation, index, newindex ) {
                                var $total = navigation.find('li').size() - 1;
                                $w4finish[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
                                $('#w4').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
                        },
                        onTabShow: function( tab, navigation, index ) {
                                var $total = navigation.find('li').length - 1;
                                var $current = index;
                                var $percent = Math.floor(( $current / $total ) * 100);
                                $('#w4').find('.progress-indicator').css({ 'width': $percent + '%' });
                                tab.prevAll().addClass('completed');
                                tab.nextAll().removeClass('completed');
                                //alert(index);
                                if (index === 1){
                                    $("#loading2").html('<div class="loading-overlay-showing" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }" >' + 
                                    '<div class="loading-overlay" style="border-radius: 0px 0px 5px 5px;">' + 
                                    '<div class="loader black"></div></div>');
                                    uploadFiles(/*event*/);
                                } 
                        }
                });
                
                
                ///GESTIÓN DE LA SUBIDA DE ARCHIVOS
                //Gestionamos la subida del archivo
        
                // Variable en la que guardaremos los archivos
                var files;

                // Añadimos manejadores de eventos para fileChange y submit
                $('input[type=file]').on('change', prepareUpload); //Cuando cambiamos los archivos, preparamos la subida
                $(formID).on('submit', checkValidation);//Cuando Submit, validamos el formulario

                function checkValidation(event){
                    if ($(formID).valid()){ //Si el formulario es válido, realizamos la subida
                        uploadFiles(/*event*/);
                    }
                }

                // Grab the files and set them to our variable
                function prepareUpload(event)
                {
                    //guardamos en la variable los archivos indicado en el input
                    //alert('cambio');
                        files = event.target.files;
                }

                // Catch the form submit and upload the files
                function uploadFiles(/*event*/)
                {
                    /*
                    event.stopPropagation(); // Paramos cualquier acción que se realice por defecto
                    event.preventDefault(); // Paramos cualquier acción que se realice por defecto
                    */
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

                                     stopSpinner();
                                     $('#wiz-validacion').load('code/accion_administracion_importar_imagenes_usuarios_validar_archivo.php?file=' + data.files + 
                                             '&tipoarchivo=' + separadorTipo); 
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


