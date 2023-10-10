<?php
require __DIR__ . '/../env.php';
require __DIR__ . '/../helpers.php';
require __DIR__ . '/../database.php';

require 'DBMigration.php';
require '01table_users.php';
require '02table_categories.php';
require '03table_podcasts.php';
require '04table_blog_posts.php';
require '05table_blog_post_comments.php';
require '05table_podcast_comments.php';
require '06table_artists.php';