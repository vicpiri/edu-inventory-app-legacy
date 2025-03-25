<form>
<div class="form-group">
        <label class="col-md-3 control-label text-right">Archivo de imágenes (*.zip)</label>
        <div class="col-md-6">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="input-append">
                                <div class="uneditable-input">
                                        <i class="fa fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                        <span class="fileupload-exists">Cambiar</span>
                                        <span class="fileupload-new">Seleccionar archivo</span>
                                        <input type="file" title="(Este campo es obligatorio)" required/>
                                </span>
                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Borrar</a>
                        </div>
                </div>
        </div>
</div>
</form>
<br/>
<div class="alert alert-warning col-md-6 col-md-offset-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>¡Atención!</strong> Debe seleccionar un archivo ZIP que contenga las imágenes de los artículos. <br/> <br/>
        El nombre de cada uno de los archivos debe ser el código del artículo representado en la foto.
        <br/> <br/>
        El tamaño límite del archivo que puede subir a este servidor es <strong><?php echo phpinimaxsize()/1024/1024; ?>Mb</strong>. 
        Si su archivo es demasiado grande, se le recomienda realizar la importación en varios lotes más pequeños.
         
</div>
