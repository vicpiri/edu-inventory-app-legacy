<form id="form1" onsubmit='return false'>
    <div class="input-group mb-md">
        <input type="text" class="form-control autofocus" name="articulo">
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" >Consultar</button>
        </span>
    </div>
</form>

<script>
    $('#form1 input').change(function(){ //Inicializamos el Lightbox cada vez que cambia el contenido del input
        console.log($('#form1').serialize());
        enviaFormularioLightbox('#form1', 'code/accion_consultar_articulos_articulo.php');
        //$('#form1 input').val('').focus();
    });
    $(".autofocus").trigger("focus");
</script>
