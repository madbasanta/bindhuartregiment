<?php

Route::get('/home/index', base_path('home/index.php'));

// podcast
Route::get('/podcasts', base_path('podcast/podcastmain.php'));
Route::get('/podcasts/{slug}', function($slug) {
    $strId = substr($slug, strpos($slug, 'id-') + 3);
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