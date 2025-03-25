<?php
//Comprobamos si la página se está cargando con datos ya enviados

if (isset($_POST['nombre'])){
    require 'config.php';
    require $baseURL . 'code/conecta_data_base.php';
    require $baseURL . 'code/main_functions.php';
    $nombre = $_POST['nombre'];
    $sql = "INSERT INTO tipos (nombre) VALUES ('$nombre')";
    
    consultaDB($sql, $db);
    
    /*
    if ($conn->query($sql) === TRUE) {
    ?>
<script>
    notification('success', 'Nuevo tipo creado','.' , 'fa fa-check');
</script>
    <?php
    } else {
        ?>
<script>
    notification('error', 'Error en la creación del tipo','.' , 'fa fa-exclamation');
</script>
    <?php 
    }*/
}
?>

<section class="panel-primary">
    <header class="panel-heading">
        <div class="panel-actions">

            <span class="fa-lg">
                <a id="csvdownload" class="fa fa-cloud-download" href="#"></a>
                <script>
                    $('#csvdownload').click(function(e){
                        e.preventDefault();  //stop the browser from following
                        window.open('<?php echo $baseURLClient ?>code/download_csv_tipos.php');
                    });
                </script>
            </span>

        </div>

        <h2 class="panel-title">Crear un nuevo tipo de artículo</h2>

    </header>
    
        <div class="panel-body" data-loading-overlay id="loadingpanel">
            <form id="form3" class="form-horizontal form-bordered">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="inputNombre">Nombre del tipo <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input name="nombre" type="text" class="form-control" id="inputNombre" placeholder="Pon un nombre" title="Este campo es obligatorio" required>
                            </div>
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipos existentes</label>
                        <div class="col-md-9">
                            <select class="form-control" size="20" id="tipo">
                                <option>-</option>
                        </select>
                        </div>
                    </div>
                </div>
            </form>
</div>
                
                    
            
    </div>
    <div class="panel-footer text-right">
        <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
        </div>
            
    </div>

</section>

<script>
//Rellenamos los tipos existentes
$("#tipo").load("code/accion_administracion_nuevo_tipo_rellena_tipos.php");

var formID = '#form3';
var urlDestino ='submit.php';
//Validamos el formulario
(function() {

	'use strict';

	// basic
	$(formID).validate({
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


$(formID +' button').click(function(){
    if($(formID).valid()){
        $('#subframe').load('code/accion_administracion_nuevo_tipo.php', $(formID).serializeArray());
    }
});

$(formID).change(function(){
    if($(formID).valid()){
        $('#subframe').load('code/accion_administracion_nuevo_tipo.php', $(formID).serializeArray());
    }
});
$(formID).submit(function (e) {
      e.preventDefault();
});
</script>
