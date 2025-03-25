<div class="col-md-6">
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions"></div><h2 class="panel-title">Consulta usuarios por Grupo</h2>
        <p class="panel-subtitle"></p></header><div class="panel-body">
        <form id="formUsuariosGrupo" onsubmit='return false'>
            <div class="input-group mb-md">
                <select class="form-control" name="grupo">

                </select>
                <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" >Consultar</button>
                </span>
            </div>
        </form>
</div></section>
</div>
<script>
    $("#formUsuariosGrupo select").load("modules/itaca/code/accion_consultar_usuarios_rellena_grupos.php");
</script>
<script>    
    $('#formUsuariosGrupo button').click(function(){ 
        $('#subframe').load('modules/itaca/code/accion_consultar_usuarios_grupo.php', $('#formUsuariosGrupo').serializeArray());
    });
</script>
