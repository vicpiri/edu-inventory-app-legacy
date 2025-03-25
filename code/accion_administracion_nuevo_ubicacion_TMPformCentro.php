<form id="formCentro" onsubmit='return false'class="form-horizontal form-bordered">
<div class="form-group">
        <label class="col-md-3 control-label text-right" for="inputHelpText">Código Centro<span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="inputHelpText" name="codigo" required title="Este campo es obligatorio">
                <span class="help-block">Introduzca el código de centro asignado por la administración.</span>
        </div>
</div>
<div class="form-group">
        <label class="col-md-3 control-label text-right">Nombre<span class="required">*</span></label>
        <div class="col-md-9">
                <div class="input-group mb-md">
                    <input type="text" class="form-control" name="nombre" required title="Este campo es obligatorio">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="centroGuardar">Guardar</button>
                        </span>
                </div>
        </div>
        <div class="text-right col-md-12">
            <a class="text-muted text-uppercase" href="#" id="botonCentrosRegistrados">(ver centros registrados)</a>
        </div>
        
</div>
</form>
<script>    
    $('#botonCentrosRegistrados').click(function(){ //Inicializamos el Lightbox cada vez que cambia el contenido del input
        enviaLightbox('', 'code/accion_administracion_nuevo_ubicacion_TMP_centros_registrados.php');
    });
   
    (function() {

            'use strict';

            // basic
            $('#formCentro').validate({
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
    $('#centroGuardar').click(function(){
        if ($('#formCentro').valid()){
            enviaLightbox($("#formCentro").serialize(), 'code/accion_administracion_nuevo_ubicacion_guardar_centro.php');
        }
    });
</script>

