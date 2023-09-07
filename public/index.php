<?php
ini_set('display_errors', 'On');
include_once __DIR__ . '/../adminadmin/env.php';

include_once __DIR__ . '/../adminadmin/helpers.php';
include_once base_path('adminadmin/middlewares.php');
include_once base_path('adminadmin/database.php');


include_once base_path('routes/Route.php');
include_once base_path('routes/authentication.php');
include_once base_path('routes/blogs.php');

Route::get('/', base_path('index.html'));
Route::get('/admin', base_path('adminadmin/dashboard.php'));

$url = explode('?', $_SERVER['REQUEST_URI'])[0];
if ($actions = (Route::$routes[$_SERVER['REQUEST_METHOD']][$url] ?? null)) {
    foreach($actions as $action) {
        if(is_callable($action)) {
            $result = $action();
        } elseif(file_exists($action)) {
            require_once($action);
        }
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $static = base_path($_SERVER['PHP_SELF']);
    if (file_exists($static)) {
        // Determine the content type based on the file extension
        $extension = pathinfo($static, PATHINFO_EXTENSION);
        $content_types = [
            'html' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            "pdf" => "application/pdf",
            "jpeg" => "image/jpeg",
            "jpg" => "image/jpeg",
            "gif" => "image/gif",
            "xml" => "application/xml",
            "json" => "application/json",
            "svg" => "image/svg+xml",
            "zip" => "application/zip",
            "mp3" => "audio/mpeg",
            "mp4" => "video/mp4",
            "csv" => "text/csv",
            "woff" => "font/woff",
            "woff2" => "font/woff",
            // Add more file extensions and corresponding content types as needed
        ];

        // Set content type if the extension is recognized, otherwise use a default type
        if (isset($content_types[$extension])) {
            header('Content-Type: ' . $content_types[$extension]);
        } else {
            // 404
            http_response_code(404);
            require_once base_path('404/404.html');
        }
        echo file_get_contents($static);
        exit;
    }
}

// 404
http_response_code(404);
require_once base_path('404/404.html');