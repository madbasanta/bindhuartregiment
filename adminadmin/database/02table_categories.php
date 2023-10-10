<?php

$schema = new DBMigration('categories');
$schema->increments('id');
$schema->string('name');
$schema->bigint('parent_id', true)->nullable();
$schema->foreign('parent_id', 'categories'); // foreign key
$schema->timestamp('created_at')->nullable();
$schema->timestamp('updated_at')->nullable();

echo '⛏ Creating table categories...' . PHP_EOL;
ORM::schema($schema->generateSQL());
echo '✔ Created table categories' . PHP_EOL;