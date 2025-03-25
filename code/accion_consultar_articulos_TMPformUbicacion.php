<form id="form3" onsubmit='return false'>
    <div class="">
    <div class="form-group">
        <label class="col-md-3 control-label" for="centro">Centro</label>
        <div class="col-md-9">
        <select id="centro" name="centro" class="form-control">
                <option>-</option>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="departamento">Departamento</label>
        <div class="col-md-9">
        <select id="departamento" name="departamento" class="form-control">
                <option>-</option>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="area">Área</label>
        <div class="col-md-9">
        <select id="area" name="area" class="form-control">
                <option>-</option>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="armario">Ubicación</label>
        <div class="col-md-9">
        <select id="armario" name="armario" class="form-control">
                <option>-</option>
        </select>
        </div>
    </div>
    <div class="form-group text-right">
        <span>
                <button class="btn btn-primary" type="button">Consultar</button>
        </span>
    </div>
    </div>
</form>

<script>
$("#centro").load("code/accion_consultar_articulos_rellena_centros.php");
$("#centro").change(function(){
    $("#departamento").load("code/accion_consultar_articulos_rellena_departamentos.php", $("#form3").serializeArray());
});
$("#departamento").change(function(){
    $("#area").load("code/accion_consultar_articulos_rellena_areas.php", $("#form3").serializeArray());
});    
$("#area").change(function(){
    $("#armario").load("code/accion_consultar_articulos_rellena_armarios.php", $("#form3").serializeArray());
});
</script>
<script>    
    $('#form3 button').click(function(){ 
        $('#subframe').load('code/accion_consultar_articulos_ubicacion.php', $('#form3').serializeArray());
    });
</script>
