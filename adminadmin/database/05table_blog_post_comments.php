<?php

$schema = new DBMigration('blog_post_comments');
$schema->increments('id');
$schema->bigint('post_id', true);
$schema->foreign('post_id', 'blog_posts'); // foreign key
$schema->string('author')->nullable();
$schema->text('comment')->nullable();
$schema->timestamp('created_at')->nullable();
$schema->timestamp('updated_at')->nullable();

echo '⛏ Creating table blog_post_comments...' . PHP_EOL;
ORM::schema($schema->generateSQL());
echo '✔ Created table blog_post_comments' . PHP_EOL;