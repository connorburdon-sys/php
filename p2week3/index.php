<?php

require_once __DIR__ . '/bootstrap.php';

use App\Config\Database;
use App\Repositories\UserRepository;

$pdo = Database::getInstance();
$repository = new UserRepository($pdo);

var_dump($repository->findByUsername('peter'));
