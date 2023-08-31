<?php

class Route 
{
    static $routes = [
        'GET' => [],
        'POST' => [],
    ];
    static function get($url, ...$action) {
        self::$routes['GET'][$url] = $action;
    }

    static function post($url, ...$action) {
        // array_unshift($action, 'formdata_content');
        self::$routes['POST'][$url] = $action;
    }
}