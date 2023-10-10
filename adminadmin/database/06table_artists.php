<?php

$schema = new DBMigration('artists');
$schema->increments('id');
$schema->string('name');
$schema->string('slug');
$schema->string('role');
$schema->text('description', 'LONG')->nullable();
$schema->text('shortdesc')->nullable();
$schema->integer('sequence', true)->nullable();
$schema->string('thumbnail')->nullable();
$schema->timestamp('created_at')->nullable();
$schema->timestamp('updated_at')->nullable();


echo '⛏ Creating table artists...' . PHP_EOL;
ORM::schema($schema->generateSQL());
echo '✔ Created table artists' . PHP_EOL;