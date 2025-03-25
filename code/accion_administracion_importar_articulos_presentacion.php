<?php
	//print_r($datosFinalesArray);
	?>

<table class="table table-bordered mb-none">
    <thead>
	<tr>
		<th>Centro</th>
		<th>C&oacute;digo</th>
		<th>Tipo</th>
		<th>Ubicaci&oacute;n</th>
		<th>Foto</th>
	</tr>
    </thead>
    <tbody>
	<?php
	$count = 1;
	$errores = 0;
	$warnings = 0;
        $success = 0;
	for($i = 1; $i <= count($datosFinalesArray); $i++){
		if (busca_errores_archivo($datosFinalesErroresArray, $i) == 0){
			//$imagen = '<img src="css/InventarioSi.png" />';
                        $success++;
		}else if (busca_errores_archivo($datosFinalesErroresArray, $i) == 2){
			//$imagen = '<img src="css/InventarioWarning.png" />';
			$warnings++;
		}else{
			//$imagen = '<img src="css/InventarioNo.png" />';
			$errores++;
		}

                ?>
                        <tr>

                            <td <?php echo deduce_clase_error($datosFinalesErroresArray, $i, $colCentro);?> ><?php echo $datosArchivo[$i][$colCentro]; ?></td>
                            <td <?php echo deduce_clase_error($datosFinalesErroresArray, $i, $colArticulo);?> ><?php echo $datosArchivo[$i][$colArticulo]; ?></td>
                            <td <?php echo deduce_clase_error($datosFinalesErroresArray, $i, $colTipo);?> ><?php echo $datosArchivo[$i][$colTipo]; ?></td>
                            <td <?php echo deduce_clase_error($datosFinalesErroresArray, $i, $colUbicacion);?> ><?php echo $datosArchivo[$i][$colUbicacion]; ?></td>
                            <td <?php echo deduce_clase_error($datosFinalesErroresArray, $i, $colFoto);?> ><?php echo $datosArchivo[$i][$colFoto]; ?></td>
                        </tr>
                <?php
			
	}	
	?>
    </tbody>
</table>
<br/>

<?php 

if ($errores > 0){
    echo alerta('En el archivo existen ' . $errores . ' artículos que producen alg&uacute;n ERROR. Si continúa, estos elementos se omitirán de la importación.' , 'danger');
}
if ($warnings > 0){
    echo alerta('En el archivo existen ' . $warnings . ' artículos que producen alg&uacute;n WARNING' , 'warning');
}
if ($success > 0){
    echo alerta('En el archivo existen ' . $success . ' artículos que superan el análisis sin alertas' , 'success');
}
    $js_datos = json_encode($datosFinalesArray);
    //echo $js_datos;
    $js_errores = json_encode($datosFinalesErroresArray);
    $js_indices = json_encode($indices);
    
    //Generamos los nombre de los archivos
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    
    $archivo_datos =  '';
    for ($i = 0; $i < 20; $i++) {
         $archivo_datos .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    $archivo_errores =  '';
    for ($i = 0; $i < 20; $i++) {
         $archivo_errores .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    $archivo_indices =  '';
    for ($i = 0; $i < 20; $i++) {
         $archivo_indices .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    //Guardamos el contenido de las variables en los archivos
    file_put_contents("$baseURL/temp/$archivo_datos", $js_datos);
    file_put_contents("$baseURL/temp/$archivo_errores", $js_errores);
    file_put_contents("$baseURL/temp/$archivo_indices", $js_indices);
?>
<script type='text/javascript'>
    <?php

    echo "var datos_articulos = '". $archivo_datos . "';\n";
    echo "var errores_articulos = '". $archivo_errores . "';\n";
    echo "var errores_totales = ". $errores. ";\n";
    echo "var indices = '". $archivo_indices. "';\n";
    ?>

    
</script>