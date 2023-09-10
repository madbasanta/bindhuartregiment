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

function old($key) {
    return $_SESSION['post_old'][$key] ?? null;
}

function str_limit($str, $limit = 50, $end = '...') {
    if(strlen($str) > $limit) {
        return substr($str, 0, $limit) . $end;
    }
    return $str;
}

function formatDuration($input) {
    // Split the input string into hours, minutes, and seconds
    list($hours, $minutes, $seconds) = explode(':', $input);

    // Calculate the total duration in hours and minutes
    $totalHours = intval($hours);
    $totalMinutes = ($totalHours * 60) + intval($minutes);

    // Format the result
    $result = '';
    if ($totalHours > 0) {
        $result .= $totalHours . ' hr ';
    }
    if ($totalMinutes > 0 || $totalHours == 0) {
        $result .= $totalMinutes . ' min';
    }

    return $result;
}

function nDate($date, $format = 'm/d/Y') {
    if(empty($date)) return '';
    $dateOjbect = date_create($date);
    return date_format($dateOjbect, $format);
}

function response($response, $status = 200)
{
    if(is_array($response) || is_object($response)) {
        header('Content-Type: application/json');
        $response = json_encode($response);
    }
    http_response_code($status);
    echo $response;
    exit;
}