<?php

ini_set('display_errors', 'On');
include_once __DIR__ . '/../adminadmin/env.php';
// include_once __DIR__ . '/../vendor/autoload.php';

include_once __DIR__ . '/../adminadmin/helpers.php';
include_once base_path('adminadmin/middlewares.php');
include_once base_path('adminadmin/database.php');


include_once base_path('routes/Route.php');
include_once base_path('routes/webRoutes.php');
include_once base_path('routes/authentication.php');
include_once base_path('routes/blogs.php');
include_once base_path('routes/podcasts.php');
include_once base_path('routes/artists.php');

Route::get('/', base_path('home.php'));
Route::get('/admin', base_path('adminadmin/dashboard.php'));

$url = urldecode(explode('?', $_SERVER['UNENCODED_URL'] ?? $_SERVER['REQUEST_URI'])[0]);
foreach(Route::$routes[$_SERVER['REQUEST_METHOD']] as $route => $actions) {
    $pregRoute = preg_replace('#\{(\w+)\}#', '([\D]+)', $route);
    // Check if the request URI matches the route pattern
    if (preg_match("#^$pregRoute$#", $url, $matches)) {
        // Extract any route parameters
        $params = array_slice($matches, 1);
        foreach($actions as $action) {
            if(is_callable($action)) {
                $result = $action(...$params);
            } elseif(file_exists($action)) {
                require_once($action);
            }
        }
        exit;
    }
}
// old route handler
// if ($actions = (Route::$routes[$_SERVER['REQUEST_METHOD']][$url] ?? null)) {
//     foreach($actions as $action) {
//         if(is_callable($action)) {
//             $result = $action();
//         } elseif(file_exists($action)) {
//             require_once($action);
//         }
//     }
//     exit;
// }

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $static = base_path($_SERVER['PHP_SELF']);
    $uriStatic = base_path(explode('?', $_SERVER['REQUEST_URI'])[0]);
    
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
            "ttf" => "font/ttf",
            "otf" => "font/otf",
            // Add more file extensions and corresponding content types as needed
        ];

        // Set content type if the extension is recognized, otherwise use a default type
        if (isset($content_types[$extension])) {
            header('Content-Type: ' . $content_types[$extension]);
            echo file_get_contents($static);
            exit;
        }
    }
    
    if (file_exists($uriStatic)) {
        // Determine the content type based on the file extension
        $extension = pathinfo($uriStatic, PATHINFO_EXTENSION);
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
            "ttf" => "font/ttf",
            "otf" => "font/otf",
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
        echo file_get_contents($uriStatic);
        exit;
    }
    // dd($static, $uriStatic, $_SERVER['REQUEST_URI']);
}

// 404
http_response_code(404);
require_once base_path('404/404.html');