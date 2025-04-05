<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    $sql = 'SELECT * FROM users WHERE username="' . $_SESSION['user'] . '"';
    $rowUsuario = consultaDB($sql, $db);
?>

<div class="col-md-12 col-lg-6 col-xl-6">
        <section class="panel panel-transparent">
                <header class="panel-heading">
                        <div class="panel-actions">
                                
                        </div>

                        <h2 class="panel-title">Mi perfil</h2>
                </header>
                <div class="panel-body">
                        <section class="panel panel-group">
                                <header class="panel-heading bg-primary">

                                        <div class="widget-profile-info">
                                                <div class="profile-picture">
                                                    <?php
                                                        if (file_exists($baseURL . 'userimages/' . $rowUsuario['foto'])){
                                                            echo "<img src ='" . $baseURLClient . "userimages/". $rowUsuario['foto'] ."' >";
                                                        }else{
                                                            echo "<img src ='" . $baseURLClient . "userimages/no_imagen.jpg'>";
                                                        }
                                                    ?>
                                                </div>
                                                <div class="profile-info">
                                                        <h4 class="name text-weight-semibold">
                                                            <?php echo $rowUsuario['nombre'] . ' ' . $rowUsuario['apellido1'] . ' ' . $rowUsuario['apellido2'];
                                                            ?>
                                                        </h4>
                                                    
                                                        <h5 class="role">
                                                            <?php
                                                                $sql = 'SELECT * FROM userlevels WHERE level=' . $rowUsuario['userlevel'];
                                                                $rowLevel = consultaDB($sql, $db);
                                                                echo $rowLevel['descripcion'];
                                                            ?>
                                                        </h5>
                                                        <div class="profile-footer">
                                                            <a href="#" onclick="accionMenu('ADM10')">(editar perfil)</a>
                                                        </div>
                                                </div>
                                        </div>

                                </header>
                                <div id="accordion">

                                        <div class="panel panel-accordion">
                                                <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                                                                         <i class="fa fa-comment"></i> Notificaciones
                                                                </a>
                                                        </h4>
                                                </div>
                                                <!-- <div id="collapse1Two" class="accordion-body collapse">
                                                        <div class="panel-body">
                                                                <ul class="simple-user-list mb-xlg">
                                                                        <li>
                                                                                <figure class="image rounded">
                                                                                        <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                                                                                </figure>
                                                                                <span class="title">No hay notificaciones</span>
                                                                                <span class="message"></span>
                                                                        </li>
                                                                        
                                                                </ul>
                                                        </div>
                                                </div>-->
                                        </div>
                                </div> 
                        </section>

                </div>
        </section>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

