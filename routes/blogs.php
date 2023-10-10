<?php

Route::get('/admin/blogs', 'authenticated', base_path('backend/blogs/index.php'));
Route::get('/admin/blogs/create', 'authenticated', base_path('adminadmin/blogs_create.php'));
Route::post('/admin/blogs/create', 'authenticated', base_path('adminadmin/blogs_create.php'));

Route::get('/admin/blogs/edit', 'authenticated', function() {
    validate([
        'id' => 'required'
    ]);
}, base_path('backend/blogs/edit.php'));

Route::post('/admin/blogs/edit', 'authenticated', function() {
    validate([
        'id' => 'required',
        'title' => 'required',
        'content' => 'required',
        'shortdesc' => 'required',
        'author' => 'required',
        'thumbnail' => 'required',
    ]);

    $blog = ORM::table('blog_posts')->find($_GET['id']);
    if(empty($blog)) {
        http_response_code(404);
        exit;
    }

    $result = ORM::transaction(function() {
        ORM::table('blog_posts')->where([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'shortdesc' => $_POST['shortdesc'],
            'category_id' => empty($_POST['category_id']) ? null : $_POST['category_id'],
            'user_id' => auth()->id,
            'author' => $_POST['author'],
            'thumbnail' => $_POST['thumbnail']
        ]);
    });

    if($result['STATUS'] === 'SUCCESS') {
        $_SESSION['post_old'] = [];
        $_SESSION['success'] = 'Blog updated successfully';
    } else {
        $_SESSION['error'] = $result['MESSAGE'];
    }
    
    header('Location: /admin/blogs/edit?id=' . $_GET['id']);
});

Route::post('/admin/blogs/get-all', 'authenticated', function() {
    $blogs = ORM::table('blog_posts')->orderBy('created_at', 'desc')->get();
    foreach($blogs as &$blog) {
        // load created user
        $blog->user = $blog->user_id ? ORM::table('users')->find($blog->user_id) : null;
        // load category
        $blog->category = $blog->category_id ? ORM::table('categories')->find($blog->category_id) : null;
        // trim content
        $blog->content = substr(strip_tags($blog->content), 0, 100);
        $blog->content = $blog->shortdesc ?: $blog->content;
    }
    // dd($blogs);
    echo json_encode($blogs);
});
Route::post('/admin/blogs/delete', 'authenticated', function() {
    $res = ORM::transaction(function() {
        $id = $_POST['id'];
        ORM::table('blog_posts')->where('id', $id)->delete();
    });
    echo json_encode($res);
});

/* 
MANAGE CATEGORIES
*/
Route::post('/admin/category/create', 'authenticated', function () {
    validate([
        'name' => 'required'
    ]);
    $alreadyExists = ORM::table('categories')->where([
        'name' => $_POST['name'],
    ])->first();
    if ($alreadyExists) {
        http_response_code(422);
        echo json_encode([
            'errors' => [
                'name' => "Category '$alreadyExists->name' already exists"
            ]
        ]);
        exit;
    }
    $cat = ORM::table('categories')->create([
        'name' => $_POST['name'],
        'parent_id' => $_POST['parent_id'] ?? null
    ]);
    echo json_encode($cat);
});
