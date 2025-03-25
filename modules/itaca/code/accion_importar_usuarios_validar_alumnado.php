<?php

echo '<strong>Análisis del archivo de Alumnado de Ítaca:</strong><br/><br/>';

echo "<script type='text/javascript'>";
echo "var tipo_archivo = ". json_encode('alumnado') .";\n";
echo "</script>";
    //Comprobamos la existencia de las columnas necesarias
    //
    //
    //Configuración de los encabezamientos de las columnas
    $colNIA = 'NIA';
    $colNombre = 'Nombre';
    $colApellido1 = 'Apellido1';
    $colApellido2 = 'Apellido2';
    $colFecha_Nacimiento = 'Fecha Nacimiento';
    $colDocumento = 'Documento';
    $colEstado = 'Estado';
    $colEnsenanza = 'Enseñanza';
    $colGrupo = 'Grupo';
    $colExpGC = 'Exp.GC';

    
    if (isset($datosArchivo)){
        //Busqueda de las columnas
        $colNIA = busca_columna($datosArchivo,1 ,$colNIA);
        $colNombre = busca_columna($datosArchivo,1 ,$colNombre);
        if ($colNombre < 0) {
            $colNombre = 'Nom';
            $colNombre = busca_columna($datosArchivo,1 ,$colNombre);
        }
        $colApellido1 = busca_columna($datosArchivo,1 ,$colApellido1);
        if ($colApellido1 < 0) {
            $colApellido1 = 'Cognom 1';
            $colApellido1 = busca_columna($datosArchivo,1 ,$colApellido1);
        }
        $colApellido2 = busca_columna($datosArchivo,1 ,$colApellido2);
        if ($colApellido2 < 0) {
            $colApellido2 = 'Cognom 2';
            $colApellido2 = busca_columna($datosArchivo,1 ,$colApellido2);
        }
        $colFecha_Nacimiento = busca_columna($datosArchivo,1 ,$colFecha_Nacimiento);
        if ($colFecha_Nacimiento < 0) {
            $colFecha_Nacimiento = 'Data Naixement';
            $colFecha_Nacimiento = busca_columna($datosArchivo,1 ,$colFecha_Nacimiento);
        }
        $colDocumento = busca_columna($datosArchivo,1 ,$colDocumento);
        if ($colDocumento < 0) {
            $colDocumento = 'Document';
            $colDocumento = busca_columna($datosArchivo,1 ,$colDocumento);
        }
        $colEstado = busca_columna($datosArchivo,1 ,$colEstado);
        if ($colEstado < 0) {
            $colEstado = 'Estat';
            $colEstado = busca_columna($datosArchivo,1 ,$colEstado);
        }
        $colEnsenanza = busca_columna($datosArchivo,1 ,$colEnsenanza);
        if ($colEnsenanza < 0) {
            $colEnsenanza = 'Ensenyança';
            $colEnsenanza = busca_columna($datosArchivo,1 ,$colEnsenanza);
        }
        $colGrupo = busca_columna($datosArchivo,1 ,$colGrupo);
        if ($colGrupo < 0) {
            $colGrupo = 'Grup';
            $colGrupo = busca_columna($datosArchivo,1 ,$colGrupo);
        }
        $colExpGC = busca_columna($datosArchivo,1 ,$colExpGC);
        if ($colExpGC < 0) {
            $colExpGC = 'Exp.GC';
            $colExpGC = busca_columna($datosArchivo,1 ,$colExpGC);
        }
        
        $indices = [];
        $indices['NIA'] = $colNIA;
        $indices['Nombre'] = $colNombre;
        $indices['Apellido1'] = $colApellido1;
        $indices['Apellido2'] = $colApellido2;
        $indices['Fecha Nacimiento'] = $colFecha_Nacimiento;
        $indices['Documento'] = $colDocumento;
        $indices['Estado'] = $colEstado;
        //$indices['Enseñanza'] = $colEnsenanza;
        $indices['Grupo'] = $colGrupo;
        $indices['Exp.GC'] = $colExpGC;

        
        //Si existen todas las columnas, procedemos con el análisis
        if (($colNIA > -1) && ($colNombre > -1) && ($colApellido1 > -1)
            && ($colApellido2 > -1) && ($colFecha_Nacimiento > -1) && ($colDocumento > -1) 
            && ($colEstado > -1) && ($colEnsenanza > -1) && ($colGrupo > -1)){

                //eliminamos las cabeceras de la variable de datos
                $datosArchivo = elimina_cabeceras($datosArchivo);

                //Creamos un duplicado del array donde realizaremos los cambios oportunos
                //Tambi�n preparamos un array para almacenar los errores que encontremos
                $datosFinalesArray = $datosArchivo;
                $datosFinalesErroresArray = array_fill(1, count($datosFinalesArray), array_fill(1, count($datosFinalesArray[1]), 0));

                ///////
                // Comprobamos que todos los grupos del archivo estén dados de alta en el sistema
                ///////
                
                function existe_grupo($grupo, &$db){
                    $sql = "SELECT * FROM grupos WHERE abreviatura='$grupo'";
                    
                    $rowGrupo = consultaDB_ALL($sql, $db);
                                        
                    if (count($rowGrupo) > 0){
                        return true;
                    }else{
                        return false;
                    }
                    
                }
                foreach ($datosArchivo as $i => $dato) {
                
                    if (!existe_grupo($dato[$colGrupo], $db)){
                        $datosFinalesErroresArray[$i][$colGrupo] = [1, 'ERR - No existe ' . $dato[$colGrupo] . ' como grupo en el sistema.'];
                    }
                }
                
                ///////
                // Comprobamos si los alumnos existen en el sistema para advertir al usuario
                ///////
                
                function existe_usuario($user, &$db){
                    $sql = "SELECT * FROM users WHERE username='$user'";
                    $rowUsuario = consultaDB_ALL($sql, $db);
                    if (count($rowUsuario) > 0){
                        return true;
                    }else{
                        return false;
                    }
                    
                }
                
                for ($i = 1; $i <= count($datosArchivo); $i++){
                    if (existe_usuario($datosArchivo[$i][$colNIA], $db)){
                        $datosFinalesErroresArray[$i][$colNIA] = [2, 'WAR - Este alumno ya existe en el sistema.'];
                    }
                }
                
                //////////
                // Comprobación de que no existen dos entradas en el archivo con el mismo id_articulo
                ///////
                
                for($a = 1; $a <= count($datosFinalesArray); $a++){
                        //Comparamos cada artículo con todos los que quedan por delante
                    
                        for ($b = $a +1; $b <= count($datosFinalesArray); $b++){
                            if ($datosFinalesArray[$a][$colNIA] === $datosFinalesArray[$b][$colNIA]){

                                $datosFinalesErroresArray[$a][$colNIA] = [2, 'WAR - Alumno duplicado en este archivo.'];
                                $datosFinalesErroresArray[$b][$colNIA] = [1, 'ERR - Alumno duplicado en este archivo (esta entrada la podrá omitir).'];
                                
                            }
                        }
                        
                }
                
                require_once '../code/accion_importar_usuarios_presentacion.php';

        }else{ //Si no se encuentran todas las columnas necesarias
                //Le damos a conocer al usuario que el archivo que ha proporcinado no contiene todas las columnas necesarias
                echo alerta('El archivo no contiene todas la columnas necesarias. Por favor,'
            . ' revise que el archivo contiene todas las columnas necesarias. Consulte el manual de usuario '
            . 'o pongase en contacto con el administrador del sistema si el problema persiste.', 'danger');
                if ($colNIA == -1){
                    echo alerta('No se encuentra la columna "NIA".', 'danger');
                }
                if ($colNombre == -1){
                    echo alerta('No se encuentra la columna "Nombre".', 'danger');
                }
                if ($colApellido1 == -1){
                    echo alerta('No se encuentra la columna "Apellido1".', 'danger');
                }
                if ($colApellido2 == -1){
                    echo alerta('No se encuentra la columna "Apellido2".', 'danger');
                }
                if ($colFecha_Nacimiento == -1){
                    echo alerta('No se encuentra la columna "Fecha Nacimiento".', 'danger');
                }
                if ($colDocumento == -1){
                    echo alerta('No se encuentra la columna "Documento".', 'danger');
                }
                if ($colEstado == -1){
                    echo alerta('No se encuentra la columna "Estado".', 'danger');
                }
                if ($colEnsenanza == -1){
                    echo alerta('No se encuentra la columna "Enseñanza".', 'danger');
                }
                if ($colGrupo == -1){
                    echo alerta('No se encuentra la columna "Grupo".', 'danger');
                }
                if ($colExpGC == -1){
                    echo alerta('No se encuentra la columna "Exp.GC".', 'danger');
                }
        }
    }else{
        //echo 'Hay problemas con la lectura del archivo. </br>';
        echo "<script>";
        echo     "notification('error', 'Hay problemas con la lectura del archivo.','.' , 'fa fa-exclamation');";
        echo "</script>";
    }