<?php

$categories = ORM::table('categories')->get();
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once(base_path('backend/blogs/create.php'));
    unset($_SESSION['post_errors']);
} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['post_errors'] = [];
    $_SESSION['post_old'] = $_POST;
    if(empty($_POST['title'])) {
        $_SESSION['post_errors']['title'] = 'Missing required field title';
    }
    $trimmedString = trim(strip_tags(str_replace("\n", "", $_POST['content'] ?? '')));
    if(empty($trimmedString)) {
        $_SESSION['post_errors']['content'] = 'Missing required field content';
    }

    if(count($_SESSION['post_errors']) === 0) {

        $result = ORM::transaction(function() {
            ORM::table('blog_posts')->create([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'category_id' => empty($_POST['category_id']) ? null : $_POST['category_id'],
                'user_id' => auth()->id
            ]);
        });

        if($result['STATUS'] === 'SUCCESS') {
            $_SESSION['post_old'] = [];
            $_SESSION['success'] = 'Blog created successfully';
        } else {
            $_SESSION['error'] = $result['MESSAGE'];
        }

    }

    require_once(base_path('backend/blogs/create.php'));
    unset($_SESSION['post_errors']);
}
