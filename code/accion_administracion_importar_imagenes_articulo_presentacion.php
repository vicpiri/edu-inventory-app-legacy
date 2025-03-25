<?php
	//print_r($datosFinalesArray);
	?>

<table class="table table-bordered mb-none">
    <thead>
	<tr>
		<th>Archivo</th>
		<th>Marca/Modelo Atículo Encontrado</th>
	</tr>
    </thead>
    <tbody>
        <?php
                foreach ((array)$correctos as $imagen) {
                    echo "<tr class='success'>";
                    echo "<td>$imagen[0]</td>";
                    echo "<td>$imagen[2]</td>";
                    echo "</tr>";
                }
                
                foreach ((array)$erroneos as $imagen) {
                    echo "<tr class='danger'>";
                    echo "<td>$imagen[0]</td>";
                    echo "<td>$imagen[2]</td>";
                    echo "</tr>";
                }
        ?>
	
    </tbody>
</table>
<br/>

<?php 

if (count($erroneos) > 0){
    echo alerta('En el lote existen ' . count($erroneos) . ' imágenes que no se corresponden con ningún artículo guardado.' , 'danger');
}

if (count ($correctos) > 0){
    echo alerta('En el lote existen ' . count ($correctos) . ' imágenes que superan el análisis sin alertas' , 'success');
}
$js_errores = json_encode($erroneos);
$js_correctos = json_encode($correctos);
$js_directorio = json_encode($directorio);

?>
<script type='text/javascript'>
    <?php

    echo "var errores = ". $js_errores . ";\n";
    echo "var correctos = ". $js_correctos . ";\n";
    echo "var directorio = ". $js_directorio . ";\n";
    ?>

    
</script>