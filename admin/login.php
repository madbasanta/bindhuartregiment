<?php


if($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once(base_path('backend/login.html'));
}

dd($_SERVER);