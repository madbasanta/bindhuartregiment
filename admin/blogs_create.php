<?php

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once(base_path('backend/blogs/create.php'));
    unset($_SESSION['post_errors']);
} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['post_errors'] = [];
    if(!isset($_POST['email'])) {
        $_SESSION['post_errors']['email'] = 'Invalid username or password';
    }
    if(!isset($_POST['password'])) {
        $_SESSION['post_errors']['password'] = 'Invalid username or password';
    }

    if(count($_SESSION['post_errors']) === 0) {
    }
}
