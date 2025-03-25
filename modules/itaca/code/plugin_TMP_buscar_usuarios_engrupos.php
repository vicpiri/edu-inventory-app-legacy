<div class="col-md-6">
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions"></div><h2 class="panel-title">Buscar usuarios en Matrículas actuales</h2>
        <p class="panel-subtitle"></p></header><div class="panel-body">
        <form id="formUsuariosEnGrupo" onsubmit='return false'>
            <div class="input-group mb-md">

                <input type="text" class="form-control" name="cadena">
                <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Buscar</button>
                </span>

            </div>
        </form>
</div></section>
</div>
<script>    
    $('#formUsuariosEnGrupo button').click(function(){
        $('#subframe').load('modules/itaca/code/accion_buscar_usuarios_engrupos.php', $('#formUsuariosEnGrupo').serializeArray());
    });
    $('#formUsuariosEnGrupo').change(function(){
        $('#subframe').load('modules/itaca/code/accion_buscar_usuarios_engrupos.php', $('#formUsuariosEnGrupo').serializeArray());
    });
</script>


