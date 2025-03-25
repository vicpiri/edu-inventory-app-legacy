<?php
require_once 'config.php';
require_once $baseURL . 'code/conecta_data_base.php';

?>

<div class="col-md-6 col-md-offset-3">
<section class="panel panel-primary">
    <header class="panel-heading">
        <div class="panel-actions"></div><h2 class="panel-title">Editar Usuario</h2>
        <p class="panel-subtitle">Introduzca el identificador del usuario que desea editar</p></header><div class="panel-body">
        <form id="formEditarUsuario" onsubmit='return false'>
            <div class="input-group mb-md">

                <input type="text" class="form-control" name="username">
                <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Editar</button>
                </span>

            </div>
        </form>
</div></section>
</div>
<script>    
    $('#formEditarUsuario button').click(function(){
        $('#subframe').load('code/accion_administracion_editar_usuario.php', $('#formEditarUsuario').serialize());
    });
    $('#formEditarUsuario').change(function(){
        $('#subframe').load('code/accion_administracion_editar_usuario.php', $('#formEditarUsuario').serialize());
    });
    
</script>