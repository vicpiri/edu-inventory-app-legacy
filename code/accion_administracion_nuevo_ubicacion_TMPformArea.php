<form id="formArea" onsubmit='return false' class="form-horizontal form-bordered">
    <div class="">
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
    </div>
    <div class="form-group">
            <label class="col-md-3 control-label text-right">Nombre<span class="required">*</span></label>
            <div class="col-md-9">
                    <div class="input-group mb-md">
                            <input type="text" class="form-control" name="area" required title="Este campo es obligatorio">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="areaGuardar">Guardar</button>
                            </span>
                    </div>
            </div>
            <div class="text-right col-md-12">
                 <a class="text-muted text-uppercase" href="#" id="botonAreasRegistrados">(ver áreas registradas)</a>
            </div>
    </div>
    </div>
</form>

<script>
    $("#areCentro").load("code/accion_administracion_nuevo_articulo_rellena_centros.php");
    $('#botonAreasRegistrados').click(function(){
        enviaLightbox($("#formArea").serialize(), 'code/accion_administracion_nuevo_ubicacion_TMP_areas_registradas.php');
    });
    $("#areCentro").change(function(){
        $("#areDepartamento").load("code/accion_administracion_nuevo_articulo_rellena_departamentos.php", $("#formArea").serializeArray());
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
    $('#areaGuardar').click(function(){
        if ($('#formArea').valid()){
            //$('#subframe').load('code/accion_administracion_nuevo_ubicacion_guardar_departamento.php', $('#formDepartamento').serializeArray());
            enviaLightbox($("#formArea").serialize(), 'code/accion_administracion_nuevo_ubicacion_guardar_area.php');
        }
    });
</script>