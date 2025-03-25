<form>
<div class="form-group">
        <label class="col-md-3 control-label text-right" for="tipoarchivo">Tipo de archivo</label>
        <div class="col-md-6">
            <select class="form-control mb-md" id="tipoarchivo" name="tipoarchivo">
                    <option value=";">CSV Delimitado por comas de MS Excel (;)</option>
                        <option value=",">Valores delimitados por comas de Google Docs (,)</option>
                        <option value=",">Texto CSV de Libre Office</option>
                </select>
        </div>
</div>
<div class="form-group">
        <label class="col-md-3 control-label text-right">Archivo de datos (*.csv)</label>
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
        <strong>¡Atención!</strong> El archivo debe ser de tipo CSV. Por favor, indique desde qué software ha exportado la información para
        asegurar la compatibilidad. <br/> <br/>
        El archivo debe contener todas las columnas necesarias. Para descargar una plantilla de ejemplo <a href="<?php echo $baseURLClient ?>downloads/Pantilla_Articulos.csv" class="alert-link">pulse aquí</a>.
        <br/> <br/>
        El límite de registros por archivo es de 3000 artículos. Por favor, si necesita importar más artículos, sepárelos en varios archivos.
         
</div>
