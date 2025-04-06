<?php
$path_to_root = './';
$folders = ['temp/' , 'modules/' , 'uploads/', 'updates/'];

foreach ($folders as $folder) {
    $uploaddir = $path_to_root . $folder;
        
    if(!is_dir($uploaddir)){
        mkdir($uploaddir);
    }
}

