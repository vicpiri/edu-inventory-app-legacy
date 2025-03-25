<form id="formArea" onsubmit='return false' class="form-horizontal form-bordered">

    <div class="form-group">
        <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
            <select id="areCentro" name="centro" class="form-control" required title="Este campo es obligatorio">
                <option>-</option>
            </select>
        </div>

        <label class="col-md-3 control-label text-right" for="departamento">Departam.<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
            <select id="areDepartamento" name="departamento" class="form-control" required title="Este campo es obligatorio">
                <option>-</option>
            </select>
        </div>

        <label class="col-md-3 control-label text-right">Área<span class="required">*</span></label>
        <div class="col-md-9">
            <div class="input-group mb-md">
                <select id="areArea" name="area" class="form-control" required title="Este campo es obligatorio">
                    <option>-</option>
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="areaEditar">Editar</button>
                </span>
            </div>
        </div>
    </div>

</form>

<script>
    $("#areCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
    $("#areCentro").change(function(){
        $("#areDepartamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php", $("#formArea").serializeArray());
    });
    $("#areDepartamento").change(function(){
        $("#areArea").load("code/accion_administracion_nuevo_articulo_rellena_areas.php", $("#formArea").serializeArray());
    }); 
    
    (function() {

            'use strict';

            // basic
            $('#formArea').validate({
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
    $('#areaEditar').click(function(){
        if ($('#formArea').valid()){
            $('#subframe').load('code/accion_administracion_editar_ubicacion_area_form.php', $('#formArea').serializeArray());
            //enviaLightbox($("#formArea").serialize(), 'code/accion_administracion_nuevo_ubicacion_guardar_area.php');
        }
    });
</script>