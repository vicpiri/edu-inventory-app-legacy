<?php

require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$articulo = (filter_input(INPUT_GET, 'articulo'));
$sql = 'SELECT * FROM articulos WHERE id_articulo = ' . $articulo;
$rowArticulo = consultaDB($sql, $db);

if (!$rowArticulo){ ?>
    <div id="custom-content" class="modal-block modal-block-md">
	<section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h3 class="col-md-8 panel-title">Error</h3></br>
		</header>
		<div class="panel-body">
			El artículo <?php echo $articulo; ?> no existe.
                </div>	
	</section>
    </div>

<?php
}else{

    $sql = 'SELECT * FROM tipos WHERE id = ' . $rowArticulo['id_tipo'];
    $rowTipo = consultaDB($sql, $db);
    
    $sql = 'SELECT * FROM armarios WHERE id_armario = ' . $rowArticulo['ubicacion'];
    $rowArmario = consultaDB($sql, $db);

    $sql = 'SELECT * FROM areas WHERE id_area = ' . $rowArmario['area'];
    $rowArea = consultaDB($sql, $db);

    $sql = 'SELECT * FROM departamentos WHERE id_departamento = ' . $rowArea['departamento'];
    $rowDepartamento = consultaDB($sql, $db);
    
    $sql = 'SELECT * FROM centros WHERE id = ' . $rowDepartamento['centro'];
    $rowCentro = consultaDB($sql, $db);



    if (intval($rowArticulo['disponibilidad']) === 0){
        $diponibilidad = 'Disponible';
    }else{
        $diponibilidad = 'BAJA';
    }
?>

<div id="custom-content" class="modal-block modal-block-lg">
	<section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
			<h3 class="col-md-8 panel-title"><?php echo $rowTipo['nombre'] ?></h3>
                        <div class="row">
				<div class="col-md-4 text-right">
                                    
				</div>
			</div>
		</header>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-4">
					<img class="img-responsive img-rounded" src="images/<?php echo buscaFotoArticulo($articulo, $db, $baseURL . 'images/') ?>" />
				</div>
                                
                                    <div class="col-md-8">
                                        <blockquote class="primary">
                                            <table class="table mb-none">
                                            <tr>
                                                <td class="text-right text-weight-semibold">Artículo: &nbsp;</td>
                                                <td><?php echo format_codigobarras($rowArticulo['id_articulo']) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Departamento: &nbsp;</td>
                                                <td><?php echo $rowDepartamento['abreviatura'] . ' - ' . $rowDepartamento['descripcion'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Área: &nbsp;</td>
                                                <td><?php echo $rowArea['nombre'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Ubicación: &nbsp;</td>
                                                <td><?php echo $rowArmario['armario'] . ' - ' . $rowArmario['descripcion'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Tipo: &nbsp;</td>
                                                <td><?php echo $rowTipo['nombre'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Marca: &nbsp;</td>
                                                <td><?php echo $rowArticulo['marca'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Modelo: &nbsp;</td>
                                                <td><?php echo $rowArticulo['modelo'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Número de serie: &nbsp;</td>
                                                <td><?php echo $rowArticulo['numeroserie'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Fecha de Alta: &nbsp;</td>
                                                <td><?php echo date("d-m-Y",strtotime($rowArticulo['fecha_alta'])) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-weight-semibold">Disponibilidad: &nbsp;</td>
                                                <td><?php echo $diponibilidad ?></td>
                                            </tr>
                                        </table>
                                        </blockquote>       
                                    </div>
                                
			</div>
                        <div class="row">
                            <div class="col-md-4">
                               
                            </div>
                            <div class="col-md-8">
                                <blockquote class="primary">
                                <h4>Descripción</h4>
                                <p><?php echo $rowArticulo['descripcion'] ?> </p>
                                </blockquote>
                            </div>
			</div>
                        <div class="row">
                            <div class="col-md-4">
                               
                            </div>
                            <div class="col-md-8">
                                <blockquote class="primary">
                                <h4>Observaciones</h4>
                                <p><?php echo $rowArticulo['observaciones'] ?> </p>
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


<script src="java/modals.js"></script>
<?php
}
?>

