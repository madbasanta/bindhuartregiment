<?php

include_once __DIR__ . '/../admin/helpers.php';


switch($_SERVER['REQUEST_URI']) {
    case '/':
        require(base_path('index.html'));
        break;
    case '/admin':
        if(auth()) {
            require(base_path('admin/dashboard.php'));
        } else {
            header('location:/login');
        }
        break;
    case '/login':
        require(base_path('admin/login.php'));
        break;
    default:
        require(base_path('404/404.html'));
        break;
}