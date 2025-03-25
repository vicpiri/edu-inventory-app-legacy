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
<div class="alert alert-warning col-md-8 col-md-offset-2">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Este asistente permite importar los siguientes lotes de información:<br/> <br/>
        
        1.- Lote de Grupos de alumnos<br/>
        2.- Lote de Alumnado, con información de la matriculación<br/>
        3.- Lote de Personal docente y no docente<br/> <br/>
        
        Desbe utilizar este mismo asistente para importar cada uno de ellos.<br/>
        
        Para descargar las plantillas para confeccionar los lotes, haga click en cada uno de los siguientes enlaces:<br/> <br/>
        <a href="<?php echo $baseURLClient ?>downloads/Pantilla_Grupos.csv" target="_blank" class="alert-link">Grupos</a> | 
        <a href="<?php echo $baseURLClient ?>downloads/Pantilla_Alumnado.csv" target="_blank" class="alert-link">Alumnado</a> | 
        <a href="<?php echo $baseURLClient ?>downloads/Pantilla_Personal.csv" target="_blank" class="alert-link">Personal</a> 
</div>
