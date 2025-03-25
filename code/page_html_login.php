<?php
include './code/copyright.php';
include './code/version.php';
?>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo pull-left">
                <img src="<?php echo $logotipo; ?>" height="54" alt="Gestor" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                    <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Login</h2>
            </div>
            <div class="panel-body">
                <?php 
                if (isset($error)){
                    echo '<p><i class="fa fa-times-circle fa-fw text-danger text-md va-middle"></i>
                    <span class="va-middle">' . $error . '</span></p>';
                }
                ?>
                <form id="form1" name="form1" action="." method="POST">
                            <div class="form-group mb-lg">
                                    <label>Usuario</label>
                                    <div class="input-group input-group-icon">
                                        <input name="username" type="password" class="form-control input-lg" value="<?php echo $user; ?>" />
                                            <span class="input-group-addon">
                                                    <span class="icon icon-lg">
                                                            <i class="fa fa-user"></i>
                                                    </span>
                                            </span>
                                    </div>
                            </div>

                            <div class="form-group mb-lg">
                                    <div class="clearfix">
                                            <label class="pull-left">Password</label>
                                           <!-- <a href="pages-recover-password.html" class="pull-right">Recordar password</a>-->
                                    </div> 
                                    <div class="input-group input-group-icon">
                                            <input name="password" type="password" class="form-control input-lg" value="<?php echo $pass; ?>" />
                                            <span class="input-group-addon">
                                                    <span class="icon icon-lg">
                                                            <i class="fa fa-lock"></i>
                                                    </span>
                                            </span>
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="col-sm-8">
                                        
                                    </div>
                                    <div class="col-sm-4 text-right">
                                            <input name="loged" type="hidden" value="1" />
                                            <button type="submit" class="btn btn-primary hidden-xs" onclick="procesarFormulario('data/login.php',$(form1).serialize());">Login</button>
                                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" onclick="procesarFormulario('data/login.php',$(form1).serialize());">Login</button>
                                    </div>
                            </div>


                    <p class="text-center">Si tienes problemas de acceso ponte en contacto con el administrador. </p>

                    </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md"><?php echo $copyright; ?> (v<?php echo $version_aplicacion; ?>)</p>
    </div>
</section>
<!-- end: page -->

