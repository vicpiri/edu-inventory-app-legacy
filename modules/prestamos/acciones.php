<?php

/* 
 * acciones.php
 * 
 * Este archivo contiene las acciones que se van a instalar con el módulo
 * 
 */

$acciones_modulo = [array(
        'accionkey' => 'PRE00',
        'nombre' => 'Préstamos',
        'descripcion' => 'Préstamos',
        'version' => '0.21',
        'paquete' => 'prestamos',
        'tipo' => 'accion',
        'menu' => 1,
        'orden' => 0,
        'parent' => 0,
        'codigoaccion' => 'modules/prestamos/code/accion_salidas.php',
        'nivel' => 2,
        'icono' => 'fa fa-sign-out'
    ),
    array(
        'accionkey' => 'DEV00',
        'nombre' => 'Devoluciones',
        'descripcion' => 'Devoluciones',
        'version' => '0.21',
        'paquete' => 'prestamos',
        'tipo' => 'accion',
        'menu' => 1,
        'orden' => 0,
        'parent' => 0,
        'codigoaccion' => 'modules/prestamos/code/accion_entradas.php',
        'nivel' => 2,
        'icono' => 'fa fa-sign-in'
    )
   ];

