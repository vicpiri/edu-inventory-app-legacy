<form id="formDepartamento" onsubmit='return false'class="form-horizontal form-bordered">
<div class="form-group">
    <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
    <div class="col-md-9 mb-md">
    <select id="depCentro" name="centro" class="form-control" required title="Este campo es obligatorio">
            <option>-</option>
    </select>
    </div>
</div>
<div class="form-group">
        <label class="col-md-3 control-label" for="abreviatura">Abreviatura<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
                <input type="text" class="form-control" id="abreviatura" name="abreviatura" required title="Este campo es obligatorio">
        </div>

        <label class="col-md-3 control-label text-right">Nombre<span class="required">*</span></label>
        <div class="col-md-9">
                <div class="input-group mb-md">
                    <input type="text" class="form-control" name="nombre" required title="Este campo es obligatorio">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="departamentoGuardar">Guardar</button>
                        </span>
                </div>
        </div>  
        <div class="text-right col-md-12">
             <a class="text-muted text-uppercase" href="#" id="botonDepartamentosRegistrados">(ver departamentos registrados)</a>
        </div>
        
</div>
</form>

<script>
    $("#depCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
    $('#botonDepartamentosRegistrados').click(function(){
        enviaLightbox($("#formDepartamento").serialize(), 'code/accion_administracion_nuevo_ubicacion_TMP_departamentos_registrados.php');
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
    $('#departamentoGuardar').click(function(){
        if ($('#formDepartamento').valid()){
            //$('#subframe').load('code/accion_administracion_nuevo_ubicacion_guardar_departamento.php', $('#formDepartamento').serializeArray());
            enviaLightbox($("#formDepartamento").serialize(), 'code/accion_administracion_nuevo_ubicacion_guardar_departamento.php');
        }
    });
</script>