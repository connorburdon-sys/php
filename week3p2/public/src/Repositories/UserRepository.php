<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Domain\User;
use PDO;

class UserRepository
{
    public function __construct(private readonly PDO $pdo) {}
    public function findByUsername(string $username): ?User 
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $statement->execute(['username' => $username]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return $this->hydrate($row);
    }

    public function register(string $username, string $email, string $passwordHash):User
    {
        $existingUser = $this->findByUsername($username);
        if ($existingUser !== null) {
            return $existingUser;
        }

        $statement = $this->pdo->prepare(
            'INSERT INTO users (username, email, password) VALUES (:username, :email, :passwordHash)'
        );
        try {
             $statement->execute([
                'username' => $username,
                'email' => $email,
                'passwordHash' => $passwordHash,
            ]);
        } catch (\PDOException $exception) {
             if ($exception->getCode() === '23000') {
            $statement->execute([
                'username' => $username,
                'email' => $email,
                'passwordHash' => $passwordHash,
            ]);
        } 

            $existingUser = $this->findByUsername($username);
            if ($existingUser !== null) {
                return $existingUser;
            }
            throw $exception;
        }
        return new User(
            id: (int) $this->pdo->lastInsertId(),
            username: $username,
            email: $email
        );
    }

    private function hydrate(array $row): User {
        return new User(
            id: (int) $row['id'],
            username: $row['username'],
            email: $row['email']
        );
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM users');
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => $this->hydrate($row), $rows);
    }

    
}