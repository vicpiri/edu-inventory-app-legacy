<!-- Modals -->
<div id="modalElementosErrores" class="modal-block modal-block-warning mfp-hide">
        <section class="panel">
                <header class="panel-heading">
                        <h2 class="panel-title">¡Error!</h2>
                </header>
                <div class="panel-body">
                        <div class="modal-wrapper">
                                <div class="modal-icon">
                                        <i class="fa fa-warning"></i>
                                </div>
                                <div class="modal-text">
                                        <h4>Hay elementos con errores en el archivo</h4>
                                        <p>El archivo que intenta guardar contiene elementos con errores. Para poder continuar puede:</br></br>
                                            - Corregir los errores que se muestan en el paso 2 y volver a subir el archivo.</br>
                                            - Marcar la opción de 'Omitir los elementos con errores.'
                                        </p>
                                </div>
                        </div>
                </div>
                <footer class="panel-footer">
                        <div class="row">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-warning modal-dismiss">OK</button>
                                </div>
                        </div>
                </footer>
        </section>
</div>

<!-- Fin de Modals -->
<div id="zonaForm">
<form id="formGuardado">
<div class="form-group">
    <label class="col-md-6 control-label text-right" for="inputSuccess"><strong>Procedimiento a seguir con los artículos existentes</strong></label>
        <div class="col-md-6">
                <div class="radio">
                        <label>
                                <input type="radio" name="optionsRadiosExistentes" id="optionsRadios1" value="option1" checked="">
                                Actualizar los elementos existentes e incluir los nuevos.
                        </label>
                </div>
                <div class="radio">
                        <label>
                                <input type="radio" name="optionsRadiosExistentes" id="optionsRadios2" value="option2">
                                Ignorar los elementos existentes. Sólo incluir los nuevos.
                        </label>
                </div>
                <div class="radio">
                        <label>
                                <input type="radio" name="optionsRadiosExistentes" id="optionsRadios3" value="option3">
                                Ignorar los elementos nuevos. Sólo actualizar los existentes.
                        </label>
                </div>

        </div>
</div>
<div class="form-group">
    <label class="col-md-6 control-label text-right" for="inputSuccess"><strong></strong></label>
        <div class="col-md-6">
                <div class="checkbox-custom">
                    <input type="checkbox" id="checkboxExample5" name="omitirErrores">
                        <label for="checkboxExample5">Omitir los elementos con errores</label>
                </div>
        </div>
</div>

</form>
<br/>
<br/>
<div class="alert alert-warning col-md-8 col-md-offset-2" id="alertGuardado">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>¡Atención!</strong><br/><br/> Seleccione el tipo de acción que desea realizar.<br/> 
        Para guardar los cambios pulse el botón de <strong>'Finalizar'</strong>.<br/><br/>
        Tenga presente que independientemente de la opción seleccionada se regenerarán todas las asignaciones de los usuarios a sus Grupos. Si
        está importando un archivo de 'Grupos por Año', esto eliminará todas las asignaciones de los usuarios a los Grupos actuales.
</div>
</div>
