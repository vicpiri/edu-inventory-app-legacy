<div class="panel panel-primary">
                    
    <header class="panel-heading">
        <h2 class="panel-title">Información del servidor de base de datos</h2>
    </header>
    <form class="form-horizontal" action="index.php" method="post">
    <div class="panel-body">

            <div class="form-group">
              <label class="control-label col-sm-2" for="url">URL:</label>
              <div class="col-sm-10">
                  <input name="url" type="text" class="form-control" id="url" placeholder="Introduzca la dirección del servidor">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="db">Database:</label>
              <div class="col-sm-10"> 
                  <input name="db" type="text" class="form-control" id="db" placeholder="Introduzca el nombre de la base de datos">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="user">User:</label>
              <div class="col-sm-10">
                  <input name="user" type="text" class="form-control" id="user" placeholder="Introduzca el usuario">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Password:</label>
              <div class="col-sm-10"> 
                  <input name="pwd" type="password" class="form-control" id="pwd" placeholder="Introduzca el password">
                <input name="stage" type="hidden" class="form-control" id="stage" value="dbcheck">
              </div>
            </div>


    </div>

    <div class="panel-footer text-right">
        <button class="btn btn-success" type="submit" class="btn btn-default">Continuar ></button>
    </div>
    </form>
</div>

