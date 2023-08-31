<?php

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(auth()) {
        return header('location:/admin');
    }

    require_once(base_path('backend/login.php'));
    unset($_SESSION['post_errors']);
} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['post_errors'] = [];
    $_SESSION['post_old'] = $_POST;
    if(empty($_POST['email'])) {
        $_SESSION['post_errors']['email'] = 'Invalid username or password';
    }
    if(empty($_POST['password'])) {
        $_SESSION['post_errors']['password'] = 'Invalid username or password';
    }

    if(count($_SESSION['post_errors']) === 0) {

        // attempt login
        $user = ORM::table('users')->where([
            'email' => $_POST['email'],
        ])->first();

        if($user && $user->password === sha1($_POST['password'])) {
            unset($user->password);
            $user->time = time();
            $_SESSION['auth'] = $user;
            return header('location:/admin');
        } else {
            $_SESSION['post_errors']['email'] = 'Invalid username or password';
        }
    } 
    require_once(base_path('backend/login.php'));
    unset($_SESSION['post_errors']);
}