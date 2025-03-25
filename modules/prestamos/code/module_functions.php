<?php

function genera_panel_prestamos($nombre, $imagen, $accion, $prestados, $contenido){
    $panel = '
                <section class="panel panel-group">
                        <header class="panel-heading bg-primary">

                                <div class="widget-profile-info">
                                        <div class="profile-picture">
                                                <img src="./userimages/' . $imagen . '">
                                        </div>
                                        <div class="profile-info">
                                                <h4 class="name text-weight-semibold">' .  $nombre  . '</h4>
                                                <h5 class="role">' . $accion . '</h5>
                                                <div class="profile-footer">
                                                        <span class="label label-danger">' . $prestados . '</span>
                                                </div>
                                        </div>
                                </div>
                        </header>
                        <div class="panel-body">' .
                            $contenido . 
            '</div>
                </section>

        ';
    return $panel;
}

