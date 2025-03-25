<form id="formDepartamento" onsubmit='return false'class="form-horizontal form-bordered">
    <div class="">
    <div class="form-group">
        <label class="col-md-3 control-label text-right" for="centro">Centro<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
        <select id="depCentro" name="centro" class="form-control" required title="Este campo es obligatorio">
                <option>-</option>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label text-right" for="abrCentro">Abreviatura<span class="required">*</span></label>
        <div class="col-md-9 mb-md">
            <input type="text" class="form-control" id="abrCentro" name="abreviatura" required title="Este campo es obligatorio">
        </div>

        <label class="col-md-3 control-label text-right">Nombre<span class="required">*</span></label>
        <div class="col-md-9">
                <div class="input-group mb-md">
                    <input type="text" class="form-control" name="departamento" required title="Este campo es obligatorio">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="departamentoGuardar">Guardar</button>
                        </span>
                </div>
        </div>
         <div class="text-right col-md-12">
             <a class="text-muted text-uppercase" href="#" id="botonDepartamentosRegistrados">(ver departamentos registrados)</a>
        </div>
    </div>
    </div>
</form>