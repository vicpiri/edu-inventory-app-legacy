<?php
require 'config.php';
require $baseURL . 'code/conecta_data_base.php';
require $baseURL . 'code/main_functions.php';

$sql = 'SELECT * FROM users WHERE username = "' . $_GET['editeduser'] . '"';

$rowsUser = consultaDB($sql, $db);

$originalDate = $rowsUser['fechadenacimiento'];

echo $newDate = date("d-m-Y", strtotime($originalDate));