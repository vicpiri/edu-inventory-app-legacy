<form id="form2" onsubmit='return false'>
    <div class="input-group mb-md">
        <select class="form-control" name="tipo">
                
        </select>
        <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" >Consultar</button>
        </span>
    </div>
</form>

<script>
    $("#form2 select").load("code/accion_consultar_articulos_rellena_tipos.php");
</script>
<script>    
    $('#form2 button').click(function(){ //Inicializamos el Lightbox cada vez que cambia el contenido del input
        $('#subframe').load('code/accion_consultar_articulos_tipo.php', $('#form2').serializeArray());
    });
</script>


