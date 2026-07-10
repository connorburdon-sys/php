<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Repositories\UserRepository;
$pdo = new PDO('mysql:host=localhost;dbname=user_repo_opdracht', 'root', 'mijnnaamisConnor1');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$userRepository = new UserRepository($pdo);

$userRepository->register(
    username: 'john',
    email: 'user@exampl.com',
    passwordHash: password_hash('password1', PASSWORD_DEFAULT)
);
return $userRepository->findByUsername('john');

