<?php

$componentFiles = glob(__DIR__ . '/*/*Component.php');

foreach($componentFiles as $componentFile) {
    require_once $componentFile;
}