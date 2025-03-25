<form id="formCentro" onsubmit='return false'class="form-horizontal form-bordered">
    <div class="form-group">
        <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
        <div class="col-md-9">
            <div class="input-group mb-md">
                <select id="cenCentro" name="centro" class="form-control" required title="Este campo es obligatorio">
                    <option>-</option>
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="centroEditar">Editar</button>
                </span>
            </div>
        </div>
    </div>
</form>
<script>
    $("#cenCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
   
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
    $('#centroEditar').click(function(){
        if ($('#formCentro').valid()){
            $('#subframe').load('code/accion_administracion_editar_ubicacion_centro_form.php', $('#formCentro').serializeArray());
        }
    });
</script>

