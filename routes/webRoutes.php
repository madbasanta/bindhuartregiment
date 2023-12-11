<?php

Route::get('/uploads/{file}', function($file) {
    $static = base_path('uploads/' . $file);
    if (file_exists($static) && !is_dir($static)) {
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
    } else {
        http_response_code(404);
        require_once(base_path('404/404.html'));
        exit;
    }
});

Route::get('/home/index', base_path('home/index.php'));

// podcast
Route::get('/podcasts', base_path('podcast/podcastmain.php'));
Route::get('/podcasts/{slug}', function($slug) {
    $strId = substr($slug, strrpos($slug, 'id-') + 3);
    $podcast = ORM::table('podcasts')->where('id', strToNumber($strId))->first();
    if(!$podcast) {
        http_response_code(404);
        require_once(base_path('404/404.html'));
        exit;
    }
    include_once(base_path('podcast/podcast.php'));
});

// artists
Route::get('/artists', base_path('artist/artist.php'));
Route::get('/artists/{slug}', function($slug) {
    $artist = ORM::table('artists')->where('slug', $slug)->first();
    if(!$artist) {
        http_response_code(404);
        require_once(base_path('404/404.html'));
        exit;
    }
    include_once(base_path('artist/artistprofile.php'));
});

// about
Route::get('/about-us', base_path('about/aboutus.php'));
// support
Route::get('/support-us', base_path('supportus/supportus.php'));
// event-projects
Route::get('/event-projects', base_path('projects/projects.php'));
// articles
Route::get('/articles', base_path('article/article.php'));
Route::get('/articles/{slug}', function($slug) {
    $strId = substr($slug, strrpos($slug, 'id-') + 3);
    $article = ORM::table('blog_posts')->where('id', strToNumber($strId))->first();
    if(!$article) {
        http_response_code(404);
        require_once(base_path('404/404.html'));
        exit;
    }
    include_once(base_path('article/article-detail.php'));
});