<?php

$schema = new DBMigration('podcast_comments');
$schema->increments('id');
$schema->bigint('podcast_id', true);
$schema->foreign('podcast_id', 'podcasts'); // foreign key
$schema->string('author')->nullable();
$schema->text('comment')->nullable();
$schema->timestamp('created_at')->nullable();
$schema->timestamp('updated_at')->nullable();

echo '⛏ Creating table podcast_comments...' . PHP_EOL;
ORM::schema($schema->generateSQL());
echo '✔ Created table podcast_comments' . PHP_EOL;
