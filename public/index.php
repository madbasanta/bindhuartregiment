<?php

function base_dir($dir = '') {
    $base = dirname(__DIR__, 2);

    if($dir === '') {
        return $base;
    }

    return $base . '/' . ltrim($dir, '\\/');
}

function dd() {
    echo '<pre>';
    foreach(func_get_args() as $arg) {
        print_r($arg);
    }
    echo '</pre>';
    exit;
}


dd($_SERVER);

echo "Welcome!!";