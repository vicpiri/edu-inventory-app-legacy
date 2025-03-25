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
        <label class="col-md-3 control-label text-right" for="ubiUbicacion">Ubicación<span class="required">*</span></label>
        <div class="col-md-9">
            <div class="input-group mb-md">
                <select id="ubiUbicacion" name="ubicacion" class="form-control" required title="Este campo es obligatorio">
                    <option>-</option>
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="ubicacionEditar">Editar</button>
                </span>
            </div>
        </div>
    </div>
</form>

<script>
    $("#ubiCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
    $("#ubiCentro").change(function(){
        $("#ubiDepartamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php", $("#formUbicacion").serializeArray());
    });
    $("#ubiDepartamento").change(function(){
        $("#ubiArea").load("code/accion_administracion_nuevo_articulo_rellena_areas.php", $("#formUbicacion").serializeArray());
    });    
    $("#ubiArea").change(function(){
        $("#ubiUbicacion").load("code/accion_administracion_nuevo_articulo_rellena_armarios.php", $("#formUbicacion").serializeArray());
    });
    
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
    $('#ubicacionEditar').click(function(){
        if ($('#formUbicacion').valid()){
            $('#subframe').load('code/accion_administracion_editar_ubicacion_ubicacion_form.php', $('#formUbicacion').serializeArray());
        }
    });
</script>
