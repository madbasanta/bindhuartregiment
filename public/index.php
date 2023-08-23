<?php

include_once __DIR__ . '/../admin/helpers.php';


switch ($_SERVER['REQUEST_URI']) {
    case '/':
        require(base_path('index.html'));
        break;
    case '/admin':
        if (auth()) {
            require(base_path('admin/dashboard.php'));
        } else header('location:/admin/login');
        break;
    case '/admin/login':
        require(base_path('admin/login.php'));
        break;
    // route blogs
    case '/admin/blogs':
        if (auth()) {
            require(base_path('backend/blogs/index.php'));
        } else header('location:/admin/login');
        break;
    case '/admin/blogs/create':
        if (auth()) {
            require(base_path('admin/blogs_create.php'));
        } else header('location:/admin/login');
        break;
    // route 404
    case '/404':
        require(base_path('404/404.html'));
        break;
    default:
        $static = base_path($_SERVER['REQUEST_URI']);
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
                "csv" => "text/csv"
                // Add more file extensions and corresponding content types as needed
            ];

            // Set content type if the extension is recognized, otherwise use a default type
            if (isset($content_types[$extension])) {
                header('Content-Type: ' . $content_types[$extension]);
            } else {
                dd($static);
            }
            echo file_get_contents($static);
        } else {
            require_once base_path('404/404.html');
        }
        break;
}
