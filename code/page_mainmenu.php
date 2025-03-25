<?php
/*
 * page_mainmenu.php
 * 
 * Este archivo se encarga de consultar las acciones disponibles para el usuario y de construir el menú principal
 * con todas esas acciones. 
 */

include_once 'code/config.php';
include_once 'code/main_functions.php';

// Consultamos la base de datos para extraer todas las acciones que puede ejecutar el usuario

if ($rowsUser['userlevel'] == 0){// Si somos desarrolladores, veremos todas las acciones
    $sql = "SELECT * FROM acciones WHERE menu AND nivel >= " . $rowsUser['userlevel'] . " ORDER BY orden";
}else{//Si no, sólo veremos las que estén en producción
    $sql = "SELECT * FROM acciones WHERE menu AND nivel >= " . $rowsUser['userlevel'] . " AND NOT nombre LIKE '%(X)' ORDER BY orden";
}

$st = $db->query($sql);
$rowsMenu = $st->fetchAll();
print '<nav id="menu" class="nav-main" role="navigation">'
. '<ul class="nav nav-main">';
function esaccion($tipo){
    switch ($tipo) {
        case 'accion':
            return TRUE;
            
        case 'accion-append':
        return TRUE;

        default:
            return FALSE;
    }
}

function buscaaccion ($id, &$rows){ //Esta función busca si existen acciones de tipo acción hijas de una determinada
    foreach ((array)$rows as $row){
        if ($row['parent'] == $id){
            if (esaccion($row['tipo'])){
                return TRUE;
                break;
            }else{
                return buscaaccion ($row['id'], $rows);
            }
        }
    }
    return FALSE;
}

// Esta función busca todos los hijos de un nivel determinado
function compruebamoduloinstalado(&$row){
    
    $instalado = false;
    $paquete = $row['paquete'];
    
    if ($paquete === 'core'){
        $instalado = true;
    }else{
        $instalado = modulecheck($paquete, '.');
    }
    
    return $instalado;
}
function buscahijos ($id, &$rows, $level){
    
    foreach ((array)$rows as $row){ //Para cada uno de los registros rescatados de la base de datos...
        if ($row['parent'] == $id){ //Si es hijo de $id
            //echo $row['parent'];
            if ($row['tipo'] === 'nodo'){ //Si es un nodo
                //Comprobamos si es un módulo instalado
                if (compruebamoduloinstalado($row)){
                    if (buscaaccion($row['id'], $rows)){ //Si la acción tiene hijos
                        print '<li class="nav-parent"><a href="#"><i class="' . $row['icono'] . '" aria-hidden="true"></i><span>' .
                            $row['nombre']. '</span></a>';
                        print '<ul class="nav nav-children">';
                        buscahijos ($row[id], $rows, $level+1); //Contruimos el menú de sus 
                        print '</ul></li>';
                    }
                }
            }elseif ($row['tipo'] === 'accion'){ //Si es una accion
                if (compruebamoduloinstalado($row)){
                    print '<li><a href="#" onclick="accionMenu(' . $row['id']
                    . ');"><i class="' . $row['icono'] . '" aria-hidden="true"></i><span>' .
                    $row['nombre']. '</span></a></li>';
                }
            }elseif ($row['tipo'] === 'accion-append'){ //Si es una accion
                if (compruebamoduloinstalado($row)){
                    print '<li><a href="#" onclick="accionMenuAppend(' . $row['id']
                    . ');"><i class="' . $row['icono'] . '" aria-hidden="true"></i><span>' .
                    $row['nombre']. '</span></a></li>';
                }
            }else{
                echo 'El tipo ' . $row['tipo'] . 'no es válido';
            }          
            
        }
    }
}

buscahijos (0, $rowsMenu, 0);
print '</ul></nav>';
