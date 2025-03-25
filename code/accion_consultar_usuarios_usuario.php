<?php

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$usuario = (filter_input(INPUT_GET, 'usuario'));
$sql = 'SELECT * FROM users WHERE username = "' . $usuario . '"';
$rowUsuario = consultaDB($sql, $db);

if (!$rowUsuario){ ?>
    <div id="custom-content" class="modal-block modal-block-md">
	<section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h3 class="col-md-8 panel-title">Error</h3></br>
		</header>
		<div class="panel-body">
			El usuario <?php echo $usuario; ?> no existe.
                </div>	
	</section>
    </div>

<?php
}else{ 
?>

<div id="custom-content" class="modal-block modal-block-lg">
	<section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
			<h3 class="col-md-8 panel-title">Información de usuario</h3>
                        <div class="row">
				<div class="col-md-4 text-right">
                                    
				</div>
			</div>
		</header>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-4">
<?php if (file_exists($baseURL . 'userimages/' . $rowUsuario["foto"])){
?>
    <img src="./userimages/<?php echo $rowUsuario["foto"]  ?>" alt="<?php echo $rowUsuario["nombre"]." ".$rowUsuario["apellido1"]." ".$rowUsuario["apellido2"]; ?>" 
         id="visorimagen" class="img-responsive img-rounded" />
<?php        
    }else{
?>
    <img src="./userimages/no_imagen.jpg" alt="<?php echo $rowUsuario["nombre"]." ".$rowUsuario["apellido1"]." ".$rowUsuario["apellido2"]; ?>" 
         id="visorimagen" class="img-responsive img-rounded" />
<?php
    }
?> 
				</div>
                                
                                    <div class="col-md-8">
                                        <blockquote class="primary">
                                            <table class="table mb-none">
                                            <tr>
                                                <td class="text-right text-weight-semibold">Identificador: &nbsp;</td>
                                                <td><?php echo $rowUsuario['username'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Nombre: &nbsp;</td>
                                                <td><?php echo $rowUsuario['nombre'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Apellidos: &nbsp;</td>
                                                <td><?php echo $rowUsuario['apellido1'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Mail: &nbsp;</td>
                                                <td><?php echo $rowUsuario['apellido2'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Nivel de Seguridad: &nbsp;</td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM userlevels WHERE level = " . $rowUsuario['userlevel'];
                                                $rowLevel = consultaDB($sql, $db);
                                                echo $rowLevel['descripcion'];
                                                ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Teléfono 1: &nbsp;</td>
                                                <td><?php echo $rowUsuario['telefono'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Teléfono 2: &nbsp;</td>
                                                <td><?php echo $rowUsuario['telefono2'] ?></td>
                                            </tr>
                                            <?php if ($rowUsuario['userlevel'] >= 3){?>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Fecha de nacimiento: &nbsp;</td>
                                                <td><?php
                                                $originalDate = $rowUsuario['fechadenacimiento'];

                                                echo $newDate = date("d-m-Y", strtotime($originalDate));
                                                ?></td>
                                            </tr>
                                            
                                            <?php
                                                $edad = time() - strtotime($originalDate);
                                            ?>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Edad: &nbsp;</td>
                                                <td><?php
                                                echo floor($edad/60/60/24/365) . ' años';
                                                ?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>

                                        </table>
                                        </blockquote>       
                                    </div>
                                
			</div>
                        
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
                                    <button class="btn btn-default modal-dismiss">Cerrar</button>
				</div>
			</div>
		</footer>
	</section>
</div>
<?php
}
?>

<script src="java/modals.js"></script>


