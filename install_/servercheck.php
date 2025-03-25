<?php
//Comprobaciones que debemos realizar
  // Versión PHP
  // session autostart
  // Escritura en las carpetas necesarias
  $errores = 0;
?>
    <div class="panel panel-primary">
        <div class="panel-heading">Comprobación de las características del servidor</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Parámetro</th>
                    <th>Valor Actual</th>
                    <th>Comentario</th>
                    <th>Comprobación</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>Versión PHP</td>
                    <td><?php echo phpversion();?></td>
                    <td>La versión debe ser igual o superior a 5.5.</td>
                    <?php
                    $version = explode('.', phpversion());
                    $decimales = '';
                    for ($i = 1; $i < sizeof($version); $i ++){
                        $decimales .= $version [$i];
                    }

                    $vernum = floatval($version[0] . '.' . $decimales);

                    if ($vernum >= 5.5){ ?>
                    <td class="text-center"><span class="label label-success">Correcto</span></td>
                    <?php }else{ ?>
                    <td class="text-center"><span class="label label-danger">Incorrecto</span></td>
                    <?php $errores ++;} ?>
                  </tr>
                  <tr>
                    <td>php.ini - session.auto_start</td>
                    <td><?php echo ini_get('session.auto_start');?></td>
                    <td>Este parámetro debe estar desactivado en php.ini.</td>
                    <?php if (ini_get('session.auto_start') == 0){ ?>
                    <td class="text-center"><span class="label label-success">Correcto</span></td>
                    <?php }else{ ?>
                    <td class="text-center"><span class="label label-danger">Incorrecto</span></td>
                    <?php $errores ++;} ?>
                  </tr>
                  <tr>
                    <td>php.ini - file_uploads</td>
                    <td><?php echo ini_get('file_uploads');?></td>
                    <td>Este parámetro debe estar activado en php.ini.</td>
                    <?php if (ini_get('file_uploads') == 1){ ?>
                    <td class="text-center"><span class="label label-success">Correcto</span></td>
                    <?php }else{ ?>
                    <td class="text-center"><span class="label label-danger">Incorrecto</span></td>
                    <?php $errores ++;} ?>
                  </tr>
                  <tr>
                    <td>php.ini - upload_max_filesize</td>
                    <td><?php echo ini_get('upload_max_filesize');?></td>
                    <td>Este parámetro limita el tamaño de subida de archivos a la aplicación.</td>
                    <td class="text-center"><span class="label label-success">Correcto</span></td>
                  </tr>
                  <tr>
                    <td>php.ini - post_max_size</td>
                    <td><?php echo ini_get('post_max_size');?></td>
                    <td>Este parámetro limita el tamaño de subida de archivos a la aplicación.</td>
                    <td class="text-center"><span class="label label-success">Correcto</span></td>
                  </tr>
                  <tr>
                    <td>Accesibilidad al directorio de instalación</td>
                    <td><?php echo is_writable('.')?></td>
                    <td>El directorio de instalación debe ser escribible.</td>
                    <?php if (is_writable('.')){ ?>
                    <td class="text-center"><span class="label label-success">Correcto</span></td>
                    <?php }else{ ?>
                    <td class="text-center"><span class="label label-danger">Incorrecto</span></td>
                    <?php $errores ++;} ?>
                  </tr>
                </tbody>
              </table>

        </div>
        <div class="panel-footer text-right">
            <?php
                if ($errores <= 0){
                    echo '<a class="btn btn-success" href="index.php?stage=dbdata">Continuar ></a>';
                }else{
                    echo '<a class="btn btn-danger" href="index.php?stage=servercheck">Volver a comprobar</a>';
                }
            ?>

        </div>

    </div>

