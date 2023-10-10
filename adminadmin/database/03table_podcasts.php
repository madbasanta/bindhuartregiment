<?php

$schema = new DBMigration('podcasts');
$schema->increments('id');
$schema->string('title');
$schema->text('description', 'LONG')->nullable();
$schema->text('shortdesc')->nullable();
$schema->time('duration')->nullable();
$schema->string('thumbnail')->nullable();
$schema->string('audio_file_path')->nullable();
$schema->string('soundcloud_url')->nullable();
$schema->string('google_url')->nullable();
$schema->bigint('user_id', true)->nullable();
$schema->foreign('user_id', 'users'); // foregin key
$schema->timestamp('podcast_date')->nullable();
$schema->timestamp('created_at')->nullable();
$schema->timestamp('updated_at')->nullable();

echo '⛏ Creating table podcasts...' . PHP_EOL;
ORM::schema($schema->generateSQL());
echo '✔ Created table podcasts' . PHP_EOL;

$schema->addColumnIfNotExists('shortdesc', 'text', ['after description'])->nullable();
$schema->addColumnIfNotExists('soundcloud_url', 'varchar(255)', ['after audio_file_path'])->nullable();
$schema->addColumnIfNotExists('google_url', 'varchar(255)', ['after soundcloud_url'])->nullable();
$schema->addColumnIfNotExists('podcast_date', 'date', ['after user_id'])->nullable();

echo '⛏ Altering table podcasts...' . PHP_EOL;
ORM::schema($schema->generateAddColumnSQL());
echo '✔ Altered table podcasts' . PHP_EOL;