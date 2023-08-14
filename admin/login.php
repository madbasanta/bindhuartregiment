<?php


if($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once(base_path('backend/login.html'));
} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
    // logic here
}