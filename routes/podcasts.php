<?php

Route::get('/admin/podcasts', 'authenticated', base_path('backend/podcasts/index.php'));
Route::get('/admin/podcasts/create', 'authenticated', base_path('backend/podcasts/create.php'));
Route::get('/admin/podcasts/edit', 'authenticated', function() {
    validate([
        'id' => 'required'
    ]);
}, base_path('backend/podcasts/edit.php'));

Route::post('/admin/podcasts/edit', 'authenticated', function() {
    validate([
        'id' => 'required',
        'title' => 'required',
        'duration' => 'required',
        'description' => 'required',
        'thumbnail' => 'required',
        'audio_file_path' => 'required',
        'podcast_date' => 'required',
        'shortdesc' => 'required',
    ]);

    $podcast = ORM::table('podcasts')->find($_GET['id']);
    if(empty($podcast)) {
        http_response_code(404);
        exit;
    }
    
    $result = ORM::transaction(function () use ($podcast) {
        ORM::table('podcasts')->where('id', $podcast->id)->update([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'thumbnail' => $_POST['thumbnail'],
            'audio_file_path' => $_POST['audio_file_path'],
            'duration' => $_POST['duration'],
            'podcast_date' => nDate($_POST['podcast_date'], 'Y-m-d'),
            'shortdesc' => $_POST['shortdesc'],
            'soundcloud_url' => $_POST['soundcloud_url'] ?? null,
            'google_url' => $_POST['google_url'] ?? null,
        ]);
    });

    if ($result['STATUS'] === 'SUCCESS') {
        $_SESSION['post_old'] = [];
        $_SESSION['success'] = 'Podcast updated successfully';
    } else {
        $_SESSION['error'] = $result['MESSAGE'];
    }
    header('Location: /admin/podcasts/edit?id=' . $_GET['id']);
});

Route::post('/admin/podcasts/get-all', 'authenticated', function () {
    $podcasts = ORM::table('podcasts')->orderBy('created_at', 'desc')->get();
    foreach ($podcasts as &$blog) {
        // load created user
        $blog->user = $blog->user_id ? ORM::table('users')->find($blog->user_id) : null;
        // trim content
        $blog->description = substr(strip_tags($blog->description), 0, 100);
    }
    echo json_encode($podcasts);
});

Route::post('/admin/podcasts/delete', 'authenticated', function () {
    $res = ORM::transaction(function () {
        $id = $_POST['id'];
        ORM::table('podcasts')->where('id', $id)->delete();
    });
    echo json_encode($res);
});

Route::post('/admin/podcasts/create', 'authenticated', function () {
    validate([
        'title' => 'required',
        'duration' => 'required',
        'description' => 'required',
        'thumbnail' => 'required',
        'audio_file_path' => 'required',
        'podcast_date' => 'required',
        'shortdesc' => 'required',
    ]);
    $result = ORM::transaction(function () {
        ORM::table('podcasts')->create([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'thumbnail' => $_POST['thumbnail'],
            'audio_file_path' => $_POST['audio_file_path'],
            'duration' => $_POST['duration'],
            'user_id' => auth()->id,
            'podcast_date' => nDate($_POST['podcast_date'], 'Y-m-d'),
            'shortdesc' => $_POST['shortdesc'],
            'soundcloud_url' => $_POST['soundcloud_url'] ?? null,
            'google_url' => $_POST['google_url'] ?? null,
        ]);
    });
    if ($result['STATUS'] === 'SUCCESS') {
        $_SESSION['post_old'] = [];
        $_SESSION['success'] = 'Podcast created successfully';
    } else {
        $_SESSION['error'] = $result['MESSAGE'];
    }
    header('Location: /admin/podcasts/create');
});

// FILE UPLOAD

Route::get('/admin/podcasts/file', function () {
    $file = $_GET['file'] ?? '';
    $path = base_path('uploads/' . $file);
    if (file_exists($path) && !is_dir($path)) {
        $info = pathinfo($path);
        header('Content-Type: audio/' . $info['extension']);
        readfile($path);
    } else {
        http_response_code(404);
        echo 'File not found';
    }
});
Route::post('/admin/file/upload', 'authenticated', function () {
    if (!empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];

        is_dir(base_path('uploads')) or mkdir(base_path('uploads'), 0777, true);

        if (move_uploaded_file($file_tmp, base_path('uploads/' . $file_name))) {
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
Route::post('/admin/file/upload/chunk', 'authenticated', function () {

    $targetDir = base_path("uploads/");
    $targetFile = $targetDir . $_POST['dzuuid'] . '.part';

    if (!empty($_FILES) && isset($_POST['dzuuid'])) {
        $chunkNumber = (int)$_POST['dzchunkindex'];
        $totalChunks = (int)$_POST['dztotalchunkcount'];

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        move_uploaded_file($_FILES['file']['tmp_name'], $targetFile . '.' . $chunkNumber);

        // Check if all chunks have been uploaded
        if ($chunkNumber + 1 == $totalChunks) {
            // Get original file name and extension
            $originalFileName = $_FILES['file']['name'];
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            $finalTargetFile = $targetDir . $_POST['dzuuid'] . '.' . $fileExtension;
            for ($i = 0; $i < $totalChunks; $i++) {
                $chunk = $targetFile . '.' . $i;
                $data = file_get_contents($chunk);
                file_put_contents($finalTargetFile, $data, FILE_APPEND);
                unlink($chunk);
            }

            response([
                'file' => basename($finalTargetFile),
                'size' => filesize($finalTargetFile)
            ]);
        }
    } else {
        response([
            'error' => 'Unable to upload file'
        ], 500);
    }
});
