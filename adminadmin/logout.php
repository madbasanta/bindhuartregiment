<?php

if(auth()) {
    session_destroy();
}
header('location: /admin/login');