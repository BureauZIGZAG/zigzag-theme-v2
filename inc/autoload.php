<?php
spl_autoload_register(function ($class) {
    // namespace prefix
    $prefix = 'Theme\\Inc\\';

    // check if this is a class from our project
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0)
        return; // nope, it isn't

    // get the relative class name
    // remove the namespace name
    $className = substr($class, $len);

    // base directory of classes
    $baseDir = __DIR__ . '/';
    // relative including
    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});