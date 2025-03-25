<!-- start: header -->
<header class="header">
    <div class="logo-container">
            <a href="<?php echo $baseURLClient; ?>" class="logo">
                    <img src="<?php echo $logotipo; ?>" height="35" alt="Gestor" />
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

            <span class="separator"></span>

            <ul class="notifications">
                    
            </ul>

            <span class="separator"></span>

            <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <?php
                                    if (file_exists($baseURL . 'userimages/' . $rowsUser["foto"])){
                                ?>
                                    <img src="./userimages/<?php echo $rowsUser["foto"]  ?>" alt="<?php echo $rowsUser["nombre"]." ".$rowsUser["apellido1"]." ".$rowsUser["apellido2"]; ?>" class="img-circle" data-lock-picture="./userimages/<?php echo $rowsUser["foto"]; ?>" />
                                <?php        
                                    }else{
                                ?>
                                    <img src="./userimages/no_imagen.jpg" alt="<?php echo $rowsUser["nombre"]." ".$rowsUser["apellido1"]." ".$rowsUser["apellido2"]; ?>" class="img-circle" data-lock-picture="./userimages/<?php echo $rowsUser["foto"]; ?>" />
                                <?php
                                    }
                                ?>                                    
                            </figure>
                            <div class="profile-info" data-lock-name="<?php echo $rowsUser["nombre"]." ".$rowsUser["apellido1"]." ".$rowsUser["apellido2"]; ?>" data-lock-email="<?php echo $rowsUser["email"]; ?>">
                                    <span class="name"><?php echo $rowsUser["nombre"]." ".$rowsUser["apellido1"]." ".$rowsUser["apellido2"] ?></span>
                                    <span class="role"><?php echo $rowsUserLevel["descripcion"]; ?></span>
                            </div>

                            <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                    <li class="divider"></li>
                                    <li>
                                            <a role="menuitem" tabindex="-1" href="#" onclick="accionMenu(22);"><i class="fa fa-user"></i> Mi perfil</a>
                                    </li>
                                    <!--<li>
                                            <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Bloquear</a>
                                    </li>-->
                                    <li>
                                            <a role="menuitem" tabindex="-1" href="#" onclick="accionGlobal(3);"><i class="fa fa-power-off"></i> Logout</a>
                                    </li>
                            </ul>
                    </div>
            </div>
    </div>
    <!-- end: search & user box -->
</header>
        <!-- end: header -->
