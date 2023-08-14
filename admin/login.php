<?php


if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(auth()) {
        return header('location:/admin');
    }

    require_once(base_path('backend/login.php'));
} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
    // logic here
    $_SESSION['email_error'] = 'Invalid username or password';
    require_once(base_path('backend/login.php'));
    
    unset($_SESSION['email_error']);
}