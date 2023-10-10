<?php

$schema = new DBMigration('users');
$schema->increments('id');
$schema->string('name')->nullable();
$schema->string('email')->nullable();
$schema->string('username')->nullable();
$schema->string('password')->nullable();
$schema->boolean('is_admin', 0);
$schema->boolean('is_locked', 0);
$schema->string('phone')->nullable();
$schema->timestamp('created_at')->nullable();
$schema->timestamp('updated_at')->nullable();

// create table users
echo '⛏ Creating table users...' . PHP_EOL;
// echo $schema->generateSQL();
ORM::schema($schema->generateSQL());
echo '✔ Created table users' . PHP_EOL;
// alter table
// $schema->addColumnIfNotExists('created_at', 'timestamp');
// $schema->addColumnIfNotExists('updated_at', 'timestamp');
// ORM::schema($schema->generateAddColumnSQL());

// alter table
// $schema->alterColumn('created_at', 'timestamp');
// ORM::schema($schema->generateAlterTableSQL());

// seed
ORM::table('users')->updateOrCreate([
    'email' => 'admin@bindhuartregiment.com',
    'username' => 'admin',
], [
    'name' => 'Bindhuart Admin',
    'password' => sha1('admin123'),
    'is_admin' => 1,
]);