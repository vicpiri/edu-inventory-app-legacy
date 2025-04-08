<?php
if (file_exists('../desarrollo.php')){
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

require_once 'config.php';
//require_once $baseURL . 'code/conecta_data_base.php';

function phpinimaxsize(){
    $maxfile = ini_get("upload_max_filesize");
    if (strpos($maxfile, 'G')){
        $maxfile = intval($maxfile) * 1024 * 1024 * 1024;
    }else if (strpos($maxfile, 'M')){
        $maxfile = intval($maxfile) * 1024 * 1024;
    }else if (strpos($maxfile, 'K')){
        $maxfile = intval($maxfile) * 1024;
    }else{
        $maxfile = intval($maxfile);
    }
    
    $maxpost = ini_get("post_max_size");
    if (strpos($maxpost, 'G')){
        $maxpost = intval($maxpost) * 1024 * 1024 * 1024;
    }else if (strpos($maxpost, 'M')){
        $maxpost = intval($maxpost) * 1024 * 1024;
    }else if (strpos($maxpost, 'K')){
        $maxpost = intval($maxpost) * 1024;
    }else{
        $maxpost = intval($maxpost);
    }
    return min([$maxfile, $maxpost]);
}

//Función que busca los modulos instalados y los devuelve en una cadena separados por comas
function modulesearch(){
    $modulos = listar_directorios_ruta('../modules/');
    $lista = '';
    foreach ((array)$modulos as $clave => $dato){
        
        //Comprobamos si está instalado
        if (file_exists('../modules/' . $dato . '/check.php')){
            include '../modules/' . $dato . '/info.php';
            if (modulecheck($dato, '..')){
                $lista .= $dato . '-' . $version_modulo . ',';
            }
        }
    }
    
    return trim($lista, ',');
}

//Función que comprueba si un módulo está instalado
function modulecheck($module, $pathroot){
    
    //ini_set('display_errors', 1);
    $file = getcwd() . '/' . $pathroot . '/modules/' . $module . '/check.php';
    //echo $file . '<br/>';
    if (file_exists($file)){
        include $file;
        
        if (isset($modulo_instalado)){
            return $modulo_instalado;
        }else{
            return false;
        }
        
    }else{
        //echo 'no existe';
        return false;
    }
    return false;
}

//Función que devuelve el código html de una alerta
function alerta ($texto, $tipo, $clases = '', $botonCerrar = false){
    $salida = '<div class="alert alert-' . $tipo . ' ' . $clases . '">';
    if ($botonCerrar){
         $salida .= '        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    }
    $salida .= $texto;
    $salida .= '</div>';
    
    return $salida;
}

//Función que rellena con ceros por delante hasta tener 8 dígitos.
function format_codigobarras($codigo){
	$i=$codigo;
	$count=0;
	
	while($i>=1){
		$i=$i/10;
		$count=$count + 1;
	}
	$i=$codigo;
	while($count < 8){
		$i='0'.$i;
		$count++;
	}
		
	$codigobarras=$i;
	
	return $codigobarras;
}

/*
 * general_panel_especial
 * 
 * esta función genera un panel con el contenido indicado en los parámetros
 * utiliza los estilos y propiedades el theme porto admin
 */
function genera_panel_especial ($header, $contenido, $footer = '', $tipo = '', $icono = ''){
    if ($tipo == 'primario'){
        $panel ='<section class="panel-primary">';
    }else{
        $panel ='<section class="panel">';
    }
    $panel .= '<header class="panel-heading">';
    $panel .= '<div class="panel-actions">';
    foreach ((array)$acciones as $accion) {
        $panel .= '<a href="#" class="' . $accion['clases'] . '"' .  $accion['otros'] .'></a>';
    }
    $panel .= '</div>';
    $panel .= '<h2 class="panel-title">' . $titulo . '</h2>';
    $panel .= '<p class="panel-subtitle">' . $subtitulo . '</p>';
    $panel .= '</header>';
    $panel .= '<div class="panel-body">' . $contenido .'</div>';
    if ($footer){
        $panel .= '<footer class="panel-footer">';
        $panel .= $footer;
        $panel .= '</footer>';
    }
    
    $panel .= '</section>';

    return $panel;
}

/*
 * general_panel
 * 
 * esta función genera un panel con el contenido indicado en los parámetros
 * utiliza los estilos y propiedades el theme porto admin
 */
function genera_panel ($titulo, $subtitulo, $acciones, $contenido, $footer = '', $tipo = '', $icono = ''){
    if ($tipo == 'primario'){
        $panel ='<section class="panel-primary">';
    }else if($tipo == 'succes'){
        $panel ='<section class="panel-succes">';
    }else if($tipo == 'danger'){
        $panel ='<section class="panel-danger">';
    }else{
        $panel ='<section class="panel">';
    }
    $panel .= '<header class="panel-heading">';
    $panel .= '<div class="panel-actions">';
    //Comprobamos si $acciones no es una cadena vacía
    if ($acciones != ''){
        foreach ((array)$acciones as $accion) {
            $panel .= '<a href="#" class="' . $accion['clases'] . '"' .  $accion['otros'] .'></a>';
        }
    }
    $panel .= '</div>';
    $panel .= '<h2 class="panel-title">' . $titulo . '</h2>';
    $panel .= '<p class="panel-subtitle">' . $subtitulo . '</p>';
    $panel .= '</header>';
    $panel .= '<div class="panel-body">' . $contenido .'</div>';
    if (1){
        $panel .= '<footer class="panel-footer">';
        $panel .= $footer;
        $panel .= '</footer>';
    }
    
    $panel .= '</section>';

    return $panel;
}

/*
 * Esta función genera una tabla a partir de los array que se le pasan como entrada
 * utilizando el código HTML del Theme
 */

function genera_tabla ($header, $datos, $tipo = ''){
    $tabla = '';
    
    // Generamos la cabecera de la tabla
    $tabla .= '<table class="table table-bordered table-striped mb-none" id="datatable-default">';
    $tabla .= '     <thead>';
    $tabla .= '           <tr>';
    foreach ((array)$header as $clave => $dato){
        $tabla .= '     <th>';
        $tabla .= $dato;
        $tabla .= '     </th>';
    }
    $tabla .= '           </tr>';
    $tabla .= '     </thead>';
            
    // Generamos el contenido de la tabla 
    $tabla .= '     <tbody>';
    foreach ((array)$datos as $clave => $dato){
        $tabla .= '     <tr>';
        foreach ((array)$dato as $clave2 => $elemento){
            $tabla .= '     <td>';
            $tabla .= $elemento;
            $tabla .= '     </td>';
        }
        //$tabla = $tabla . $dato . '</br>';
        $tabla .= '     </tr>';
    }
    $tabla .= '     </tbody>';
    //Generamos el final de la tabla
    $tabla .= '</table>';
    
    return $tabla;
}

/*
 * listar_directorios_ruta
 * 
 * Esta función lista los directorios contenidos en una determinada ruta y los
 * devuelve en un array. Esta función no busca subdirectorios.
 */

function listar_directorios_ruta($ruta){ 
   // abrir un directorio y listarlo recursivo 
    $directorios = NULL;
    if (is_dir($ruta)) { 
        if ($dh = opendir($ruta)) { 
            $i = 0;
            while (($file = readdir($dh)) !== false) { 
                if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
                $directorios[$i] = $file;
                $i ++;
                }
            } 
            closedir($dh); 
        }
        return $directorios;
    }else{
        return NULL;
    }
}



/* busca_plugin
 * 
 * Esta función busca e incluye el código de todos los plugins encontrados y activos
 * en la carpeta de módulos
 */
function busca_plugin($accionkey, $tipo){
    
    $modulos = listar_directorios_ruta('../modules/');
    
    foreach ((array)$modulos as $module) {
        if (file_exists('../modules/' . $module . '/check.php')){
            include '../modules/' . $module . '/check.php';
            if (file_exists('../modules/' . $module . '/plugin.php') && $modulo_instalado){
                include '../modules/' . $module . '/plugin.php';
            }
        }
    }
}

/* borrararchivosusuario
 * Esta función borra todos los archivos temporales del usuario en el servidor
 */


function borrararchivosusuario($user){
    $sql = "SELECT * FROM archivos WHERE user='$user'";

    //Borrado de los archivos temporales del usuario (este código se debería modificar para guardar
    //los archivos en una carpeta temporal con el nombre del usuario que después borraremos
    //cuando cerremos la sesión.
    /*if ($st = $db->query($sql)){ //Si existen archivos temporales, los borramos

        while ($rows2 = $st->fetch()){
            if (unlink($tempDir.$rows2["archivo"])){
                $archivo = $rows2["archivo"];
                $sql = "DELETE FROM archivos WHERE archivo='$archivo'";
                $st = $db->query($sql);
            }
        }

    }*/
}

/* buscaFotoArticulo
 * 
 * Esta función devuelve la fotografía asociada en la base de datos si existe el archivo
 * en el servidor. Si no, devuelve la fotografía por defecto.
 */

function buscaFotoArticulo($articulo, &$db, $url){
    $sql = "SELECT * FROM articulos WHERE id_articulo=$articulo";
    
    $rowArticulo = consultaDB($sql, $db);
   
    if (file_exists($url . $rowArticulo['foto'])){
        
        return $rowArticulo['foto'];
    }else{
        return 'No_imagen.jpg';
    }
    
    
}


/* consultaDB
 * Esta función auna todas sentencias necesarias para ejecutar una consulta a la
 * base de datos de la aplicación y devielve el resultado. También maneja los errores
 * pueda provocar la consulta
 */

function consultaDB ($sql, &$db){
    try{
    $st = $db->query($sql);
    if (!$st) {
        //echo "\nPDO::errorInfo(): \n";
        //print_r($db->errorInfo());
        return \NULL;
    }
    $rows = $st->fetch();
    return $rows;
    }catch (PDOException $e) {
        echo "<script> alert('Problema con la base de datos: " . $e->getMessage() . "')</script>";
        return false;
    }
}

function consultaDB_ALL ($sql, &$db){
    try{
    $st = $db->query($sql);
    if (!$st) {
        //echo "\nPDO::errorInfo(): \n";
        //print_r($db->errorInfo());
        return \NULL;
    }
    $rows = $st->fetchAll();
    return $rows;
    }catch (PDOException $e) {
        echo "<scrip> alert('Problema con la base de datos: " . $e->getMessage() . "')</script>";
        return false;
    }
}

//Funci�n que devuelve en un vector todos los elementos diferentes que encuentra
//en otro vector que se le entrega como par�metro

function extrae_diferentes($entrada){
	
	$salida = array_unique($entrada);
	
	return $salida;
}

function dropAccents($incoming_string){        
        $tofind = "ÀÁÂÄÅàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
        $replac = "AAAAAaaaaOOOOooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
        return utf8_encode(strtr(utf8_decode($incoming_string), 
                                utf8_decode($tofind),
                                $replac));
}  

//Función que devuelve el �ndice de la columna buscada a partir del nombre de la cabecera

function busca_columna($tabla, $cabecera, $nombre_columna){
    //echo '</br>';
    
	for ($c=0; $c < count($tabla[$cabecera]); $c++){
            //echo 'titulo tabla '. preg_replace('/\s+/', '', strtolower($tabla[$cabecera][$c])) . '-' . preg_replace('/\s+/', '', $nombre_columna) . '</br>';
            $cabecera_string = dropAccents(preg_replace('/\s+/', '', strtolower($tabla[$cabecera][$c])));
            $columna_string = dropAccents(preg_replace('/\s+/', '', strtolower($nombre_columna)));
            
            if ($cabecera_string === $columna_string){
                    return $c;
            }
	}
	return -1;
}
	
//Funci�n que extrae una columna de una tabla en un array

function extrae_columna($tabla, $columna){
	
	for ($i = 1; $i <= count($tabla); $i++){
		$salida[$i] = $tabla[$i][$columna];
	}
	
	return $salida;
}

//Funci�n que elimina la fila de cabeceras de una tabla

function elimina_cabeceras($tabla){
	
	for ($i = 1; $i < count($tabla); $i++){
		$salida[$i] = $tabla[$i + 1];
	}
	
	return $salida;
}

//Funci�n que busca el error mas alto en una tabla de errores, y lo devuelve
function busca_errores_archivo($errores, $fila) {
    $error = 0;

    if (!isset($errores[$fila]) || !is_array($errores[$fila])) {
        return 0;
    }

    foreach ($errores[$fila] as $item) {
        if (is_array($item) && isset($item[0])) {
            if ($item[0] === 1) {
                $error = 1;
            } elseif ($item[0] === 2 && $error === 0) {
                $error = 2;
            }
        }
    }

    return $error;
}

//Funci�n que devuelve un tipo de clase diferente atendiendo al tipo de error encontrado.
function deduce_clase_error($errores, $fila, $columna) {
    if (
        isset($errores[$fila][$columna]) &&
        is_array($errores[$fila][$columna]) &&
        isset($errores[$fila][$columna][0], $errores[$fila][$columna][1])
    ) {
        if ($errores[$fila][$columna][0] === 2) {
            return 'class="warning" title="' . $errores[$fila][$columna][1] . '"';
        } elseif ($errores[$fila][$columna][0] === 1) {
            return 'class="danger" title="' . $errores[$fila][$columna][1] . '"';
        }
    }

    return 'class=""';
}



/* Función que comprueba los datos del archivo importado con las relaciones que hay en una tabla de la base de datos.
 * $datosArchivo, array con los datos del archivo
 * $datosFinalesArray, array con los datos finales que se guardarán
 * $datosFinalesErroresArray,  array de errores con las dimensiones del array de datos
 * $colTipo, indice de la columna de los arrays que estamos analizando
 * $tabla, tabla de la base de datos relacionada con la columna anterior
 * $columnaTablaId, columna de la tabla que contiene el valor clave
 * $columnaTablaNombre, columna de la tabla que contiene el texto a buscar
 */


function cruza_columna($datosArchivo, $datosFinalesArray, $datosFinalesErroresArray, $colTipo, $tabla, $columnaTablaId, $columnaTablaNombre){
	//Primero extraemos del archivo los elementos diferentes que se intentan insertar
	$tiposArray = extrae_diferentes(extrae_columna($datosArchivo, $colTipo));
        
	//Ahora comprobamos uno a uno los elementos. Para ello construiremos un array de �ndices que albergar� el �ndice que concuerde con la tabla tipos
	//depu�s sustituiremos estos �ndices en la matriz de datos principal
        require 'config.php';
        require 'conecta_data_base.php';

	$keys = array_keys($tiposArray);
	for($a = 0; $a < count($tiposArray); $a++){
	
	
		$tiposArrayIndex[$a] = 0;
	
		//Si el valor es entero, lo comparamos con los indices
		if (is_numeric($tiposArray[$keys[$a]])){
			$sql = 'SELECT * FROM ' . $tabla . ' WHERE ' . $columnaTablaId . ' = ' . $tiposArray[$keys[$a]];
			
                        $row = consultaDB($sql, $db);
				
			$tiposArrayIndex[$a] =  $row[$columnaTablaId];
				
		}else{ //Si el valor no es entero lo comparamos con el nombre de tipo
			$sql = 'SELECT * FROM ' . $tabla . ' WHERE ' . $columnaTablaNombre . ' = "' . $tiposArray[$keys[$a]] . '"';
				
			$row = consultaDB($sql, $db);
				
			$tiposArrayIndex[$a] =  $row[$columnaTablaId];
		}
	}/**/
	
	//Ahora que ya tenemos los indices extraidos de los art�culos, vamos a sustituirlos en la matriz principal
	
	for($i = 1; $i <= count($datosFinalesArray); $i++){
		for($a = 0; $a < count($tiposArrayIndex); $a++){
			if ($tiposArray[$keys[$a]] == $datosFinalesArray[$i][$colTipo]){
				if ($tiposArrayIndex[$a] <> 0){
					$datosFinalesArray[$i][$colTipo] = $tiposArrayIndex[$a];
				}else{
					$datosFinalesErroresArray[$i][$colTipo] =  [1, 'ERR - No se encuentra este identificador en ' . $tabla . ''];
				}
			}
		}
	}
	
	$resultado = array('finales' => $datosFinalesArray, 'errores' => $datosFinalesErroresArray);
	
	return $resultado;
}