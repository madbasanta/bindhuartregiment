<?php

if(!auth()) {
    return header('Location: /admin/login');
}

require_once base_path('backend/index.php');