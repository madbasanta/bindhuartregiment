<?php


if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(auth()) {
        return header('location:/admin');
    }

    require_once(base_path('backend/login.php'));
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
        // attempt login
        if($_POST['email'] === 'admin@bindhuartregiment.com' && $_POST['password'] === 'admin123') {
            $_SESSION['auth'] = [
                'time' => time(),
                'name' => 'Administrator'
            ];
            return header('location:/admin');
        } else {
            $_SESSION['post_errors']['email'] = 'Invalid username or password';
        }
    } 
    require_once(base_path('backend/login.php'));
    unset($_SESSION['post_errors']);
}