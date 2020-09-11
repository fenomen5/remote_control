<?php


spl_autoload_register(function ($class) {

    $namespace = 'Pult\\';
    $path = '';


    if (0 !== strpos($class, $namespace)) {
        return;
    }

    $class = str_replace($namespace, '', $class);

    $file = realpath(__DIR__ . "/{$path}");
    $file = $file . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($file)) {
        include($file);
    }

});