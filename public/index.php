<?php

function base_dir($dir = '') {
    $base = dirname(__DIR__);

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

dd(base_path('index.html'));


switch($_SERVER['REQUEST_URI']) {
    case '/':
        require(base_path('index.html'));
        break;
    default:
        require(base_path('404/404.html'));
        break;
}