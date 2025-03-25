<?php

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$armario = (filter_input(INPUT_GET, 'armario'));
$sql = "SELECT * FROM armarios WHERE armario = '$armario'";
$rowArmario = consultaDB($sql, $db);

if (!$rowArmario){ ?>
    <div id="custom-content" class="modal-block modal-block-md">
	<section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h3 class="col-md-8 panel-title">Error</h3></br>
		</header>
		<div class="panel-body">
			No hay información de la ubicación <?php echo $armario; ?>. <br/>
                        Por favor, póngase en contacto con un administrador del sistema.
                </div>	
	</section>
    </div>

<?php
}else{
/*
    $sql = 'SELECT * FROM tipos WHERE id = ' . $rowArticulo['id_tipo'];
    $rowTipo = consultaDB($sql, $db);

    $sql = 'SELECT * FROM areas WHERE id_area = ' . $rowArticulo['id_area'];
    $rowArea = consultaDB($sql, $db);

    $sql = 'SELECT * FROM centros WHERE id = ' . $rowArticulo['id_centroo'];
    $rowCentro = consultaDB($sql, $db);

    $sql = 'SELECT * FROM armarios WHERE id_armario = ' . $rowArticulo['ubicacion'];
    $rowArmario = consultaDB($sql, $db);

    $sql = 'SELECT * FROM departamentos WHERE id_departamento = ' . $rowArticulo['id_departamento'];
    $rowDepartamento = consultaDB($sql, $db);

    if (intval($rowArticulo['disponibilidad']) === 0){
        $diponibilidad = 'Disponible';
    }else{
        $diponibilidad = 'BAJA';
    }*/
    $sql = 'SELECT * FROM areas WHERE id_area = ' . $rowArmario['area'];
    $rowArea = consultaDB($sql, $db);
    
    $sql = 'SELECT * FROM departamentos WHERE id_departamento = ' . $rowArea['departamento'];
    $rowDepartamento = consultaDB($sql, $db);
    
?>
    

<div id="custom-content" class="modal-block modal-block-full">
	<section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h3 class="col-md-8 panel-title"><?php echo $rowArmario['descripcion'] ?></h3>
                <div class="row">
                        <div class="col-md-4 text-right">

                        </div>
                </div>
            </header>
            <div class="panel-body">

                    <div class="row">
                            <div class="col-md-8">
                                    <?php
                                        if ($rowArmario['plano']===''){
                                            echo '<div class="text-center">No existe plano de la ubicación</div>';
                                        }elseif(file_exists($baseURL . "planosUbicacion/" . $rowArmario['plano'])){
                                            echo '<img class="img-responsive img-rounded" '
                                            . 'src="planosUbicacion/' . $rowArmario['plano'] . '" />';
                                        }else{
                                            echo '<div class="text-center">No existe plano de la ubicación</div>';
                                        }
                                    ?>
                            </div>

                                <div class="col-md-4">
                                    <blockquote class="primary">
                                        <table class="table mb-none">
                                        <tr>
                                            <td class="text-right text-weight-semibold">Código Ubicacion: &nbsp;</td>
                                            <td><?php echo $rowArmario['armario'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right text-weight-semibold">Departamento: &nbsp;</td>
                                            <td><?php echo $rowDepartamento['abreviatura'] . ' - ' . $rowDepartamento['descripcion'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right text-weight-semibold">Área: &nbsp;</td>
                                            <td><?php echo $rowArea['nombre'] ?></td>
                                        </tr>
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

