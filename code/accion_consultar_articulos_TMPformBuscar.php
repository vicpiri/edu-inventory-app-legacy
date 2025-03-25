<form id="form4" onsubmit='return false'>
    <div class="input-group mb-md">
        <input type="text" class="form-control" name="cadena">
        <span class="input-group-btn">
                <button class="btn btn-primary" type="button">Buscar</button>
        </span>
    </div>
</form>

<script>    
    $('#form4 button').click(function(){
        $('#subframe').load('code/accion_consultar_articulos_buscar.php', $('#form4').serializeArray());
    });
    $('#form4').change(function(){
        $('#subframe').load('code/accion_consultar_articulos_buscar.php', $('#form4').serializeArray());
    });
</script>


