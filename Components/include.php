<?php

// get folders in this directory
$folders = glob( __DIR__ . '/*' , GLOB_ONLYDIR );

// loop through folders
foreach($folders as $folder) {
    $folderName = basename($folder);
    $componentFile = $folder . DIRECTORY_SEPARATOR . $folderName . '.php';
    // check if component file exists
    if (file_exists($componentFile)) {
        // include component file
        require_once $componentFile;
    }
}