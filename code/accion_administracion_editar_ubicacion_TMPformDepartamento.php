<form id="formDepartamento" onsubmit='return false'class="form-horizontal form-bordered">
    <div class="form-group">
        <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
            <select id="depCentro" name="centro" class="form-control" required title="Este campo es obligatorio">
                <option>-</option>
            </select>
        </div>

        <label class="col-md-3 control-label text-right">Departam.<span class="required">*</span></label>
        <div class="col-md-9">
            <div class="input-group mb-md">
                <select id="depDepartamento" name="departamento" class="form-control" required title="Este campo es obligatorio">
                    <option>-</option>
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="departamentoEditar">Editar</button>
                </span>
            </div>
        </div>  
    </div>
</form>

<script>
    $("#depCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
    $("#depCentro").change(function(){
        $("#depDepartamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php", $("#formDepartamento").serializeArray());
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
    $('#departamentoEditar').click(function(){
        if ($('#formDepartamento').valid()){
            $('#subframe').load('code/accion_administracion_editar_ubicacion_departamento_form.php', $('#formDepartamento').serializeArray());
        }
    });
</script>