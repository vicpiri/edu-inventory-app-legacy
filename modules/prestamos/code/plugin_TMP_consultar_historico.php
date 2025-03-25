<div class="col-md-6">
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions"></div><h2 class="panel-title">Consulta histórico de artículo</h2>
        <p class="panel-subtitle"></p></header><div class="panel-body">
        <form id="formHistorico" onsubmit='return false'>
            <div class="input-group mb-md">

                <input type="text" class="form-control" name="cadena">
                <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Consultar</button>
                </span>

            </div>
        </form>
</div></section>
</div>
<script>    
    $('#formHistorico button').click(function(){ 
        $('#subframe').load('modules/prestamos/code/accion_consultar_historico.php', $('#formHistorico').serializeArray());
    });
    $('#formHistorico input').change(function(){ //Inicializamos el Lightbox cada vez que cambia el contenido del input
        $('#subframe').load('modules/prestamos/code/accion_consultar_historico.php', $('#formHistorico').serializeArray());
    });
</script>
