<?php

$schema = new DBMigration('blog_posts');
$schema->increments('id');
$schema->string('title');
$schema->text('content', 'LONG')->nullable();
$schema->text('shortdesc')->nullable();
$schema->string('author')->nullable();
$schema->string('thumbnail')->nullable();
$schema->bigint('user_id', true);
$schema->foreign('user_id', 'users'); //foreign key
$schema->bigint('category_id', true);
$schema->foreign('category_id', 'categories'); // foreign key
$schema->timestamp('created_at')->nullable();
$schema->timestamp('updated_at')->nullable();

echo '⛏ Creating table blog_posts...' . PHP_EOL;
ORM::schema($schema->generateSQL());
echo '✔ Created table blog_posts' . PHP_EOL;