<?php

Route::get('/admin/blogs', 'authenticated', base_path('backend/blogs/index.php'));
Route::get('/admin/blogs/create', 'authenticated', base_path('adminadmin/blogs_create.php'));
Route::post('/admin/blogs/create', 'authenticated', base_path('adminadmin/blogs_create.php'));

Route::post('/admin/blogs/get-all', 'authenticated', function() {
    $blogs = ORM::table('blog_posts')->orderBy('created_at', 'desc')->get();
    foreach($blogs as &$blog) {
        // load created user
        $blog->user = $blog->user_id ? ORM::table('users')->find($blog->user_id) : null;
        // load category
        $blog->category = $blog->category_id ? ORM::table('categories')->find($blog->category_id) : null;
        // trim content
        $blog->content = substr(strip_tags($blog->content), 0, 100);
    }
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
