<?php
session_start();


function base_path($dir = '') {
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
        echo '<br>';
    }
    echo '</pre>';
    exit;
}

function auth() {
    /* 
        id,name,email,username,is_locked,is_admin
    */
    return $_SESSION['auth'] ?? null;
}