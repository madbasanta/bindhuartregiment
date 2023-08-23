<?php
session_start();
$config = require_once __DIR__ . '/config.php';

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

function config($key, $default = null) {
    $deep = explode('.', $key);

    
    global $config;

    $data = $config;

    $value = null;
    foreach($deep as $deepKey) {
        if(isset($data[$deepKey])) {
            $value = $data[$deepKey];
            $data = $value;
        }
    }
    return $value ?? $default;
}

function is_route($regex)
{
    return preg_match('#^' . $regex . '$#', $_SERVER['REQUEST_URI']);
}