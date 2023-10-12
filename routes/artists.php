<?php

Route::get('/admin/artists', 'authenticated', base_path('backend/artists/index.php'));

Route::get('/admin/artists/create', 'authenticated', base_path('backend/artists/create.php'));

Route::get('/admin/artists/edit', 'authenticated', function() {
    validate([
        'id' => 'required',
    ]);
}, base_path('backend/artists/edit.php'));

Route::post('/admin/artists/get-all', 'authenticated', function() {
    $artists = ORM::table('artists')->orderBy('sequence', 'asc')->get();
    foreach($artists as $artist) {
        $artist->description = substr(strip_tags($artist->description), 0, 100);
    }
    echo json_encode([
        'data' => $artists,
    ]);
});


Route::post('/admin/artists/delete', 'authenticated', function () {
    $res = ORM::transaction(function () {
        $id = $_POST['id'];
        ORM::table('artists')->where('id', $id)->delete();
    });
    echo json_encode($res);
});

Route::post('/admin/artists/create', 'authenticated', function() {
    validate([
        'slug' => 'required|unique:artists',
        'name' => 'required',
        'role' => 'required',
        'shortdesc' => 'required',
        'description' => 'required',
        'thumbnail' => 'required',
        'sequence' => 'required|numeric',
    ]);
    $result = ORM::transaction(function() {
        return ORM::table('artists')->create([
            'slug' => $_POST['slug'],
            'name' => $_POST['name'],
            'role' => $_POST['role'],
            'shortdesc' => $_POST['shortdesc'],
            'description' => $_POST['description'],
            'thumbnail' => $_POST['thumbnail'],
            'sequence' => $_POST['sequence'],
        ]);
    });
    if ($result['STATUS'] === 'SUCCESS') {
        $_SESSION['post_old'] = [];
        $_SESSION['success'] = 'Artist created successfully';
    } else {
        $_SESSION['error'] = $result['MESSAGE'];
    }
    header('Location: /admin/artists/create');
});

Route::post('/admin/artists/edit', 'authenticated', function() {
    validate([
        'id' => 'required',
        'slug' => 'required',
        'name' => 'required',
        'role' => 'required',
        'shortdesc' => 'required',
        'description' => 'required',
        'thumbnail' => 'required',
        'sequence' => 'required|numeric',
    ]);
    $result = ORM::transaction(function() {
        return ORM::table('artists')->where('id', $_GET['id'])->update([
            'slug' => $_POST['slug'],
            'name' => $_POST['name'],
            'role' => $_POST['role'],
            'shortdesc' => $_POST['shortdesc'],
            'description' => $_POST['description'],
            'thumbnail' => $_POST['thumbnail'],
            'sequence' => $_POST['sequence'],
        ]);
    });
    if ($result['STATUS'] === 'SUCCESS') {
        $_SESSION['post_old'] = [];
        $_SESSION['success'] = 'Artist updated successfully';
    } else {
        $_SESSION['error'] = $result['MESSAGE'];
    }
    header('Location: /admin/artists/edit?id='. $_GET['id']);
});

