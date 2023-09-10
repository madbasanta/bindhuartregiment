<?php

Route::get('/admin/podcasts', 'authenticated', base_path('backend/podcasts/index.php'));
Route::get('/admin/podcasts/create', 'authenticated', base_path('backend/podcasts/create.php'));

Route::post('/admin/podcasts/get-all', 'authenticated', function() {
    $podcasts = ORM::table('podcasts')->orderBy('created_at', 'desc')->get();
    foreach($podcasts as &$blog) {
        // load created user
        $blog->user = $blog->user_id ? ORM::table('users')->find($blog->user_id) : null;
        // trim content
        $blog->description = substr(strip_tags($blog->description), 0, 100);
    }
    echo json_encode($podcasts);
});

Route::post('/admin/podcasts/delete', 'authenticated', function() {
    $res = ORM::transaction(function() {
        $id = $_POST['id'];
        ORM::table('podcasts')->where('id', $id)->delete();
    });
    echo json_encode($res);
});

Route::post('/admin/podcasts/create', 'authenticated', function() {
    validate([
        'title' => 'required',
        'duration' => 'required',
        'description' => 'required',
        'thumbnail' => 'required',
        'audio_file_path' => 'required',
    ]);
    $result = ORM::transaction(function() {
        ORM::table('podcasts')->create([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'thumbnail' => $_POST['thumbnail'],
            'audio_file_path' => $_POST['audio_file_path'],
            'duration' => $_POST['duration'],
            'user_id' => auth()->id,
        ]);
    });
    if($result['STATUS'] === 'SUCCESS') {
        $_SESSION['post_old'] = [];
        $_SESSION['success'] = 'Podcast created successfully';
    } else {
        $_SESSION['error'] = $result['MESSAGE'];
    }
    header('Location: /admin/podcasts/create');
});

// FILE UPLOAD

Route::get('/admin/podcasts/file', function() {
    $file = $_GET['file'] ?? '';
    $path = base_path('uploads/' . $file);
    if(file_exists($path) && !is_dir($path)) {
        $info = pathinfo($path);
        header('Content-Type: audio/' . $info['extension']);
        readfile($path);
    } else {
        http_response_code(404);
        echo 'File not found';
    }
});
Route::post('/admin/file/upload', 'authenticated', function() {
    if(!empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];

        is_dir(base_path('uploads')) OR mkdir(base_path('uploads'), 0777, true);

        if(move_uploaded_file($file_tmp, base_path('uploads/' . $file_name))) {
            header('Content-Type: application/json');
            echo json_encode([
                'file' => $file_name,
                'size' => $file_size
            ]);
        } else {
            http_response_code(500);
            echo 'Unable to upload file';
        }
    }
});

// frontend
Route::get('/podcast/podcastmain', base_path('podcast/podcastmain.php'));
Route::get('/podcast/podcast', base_path('podcast/podcast.php'));