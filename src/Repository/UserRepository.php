<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\User;
use DateTimeImmutable;
use PDO;

final class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findById(int $id): ?User
    {
        $sql = "SELECT id, firstname, lastname, email, password, phone, role, created_at
                FROM users
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ? $this->hydrateUser($row) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT id, firstname, lastname, email, password, phone, role, created_at
                FROM users
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch();
        return $row ? $this->hydrateUser($row) : null;
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        $sql = "SELECT id, firstname, lastname, email, password, phone, role, created_at
                FROM users
                WHERE role != 'admin'
                ORDER BY lastname ASC, firstname ASC";

        $stmt = $this->pdo->query($sql);

        $users = [];
        while ($row = $stmt->fetch()) {
            $users[] = $this->hydrateUser($row);
        }

        return $users;
    }

    /**
     * @param array<string, mixed> $row
     */
    private function hydrateUser(array $row): User
    {
        // created_at est un TIMESTAMP : MySQL renvoie souvent une string "YYYY-MM-DD HH:MM:SS"
        $createdAt = isset($row['created_at']) ? new DateTimeImmutable((string)$row['created_at']) : null;

        $user = new User(
            firstname: (string) $row['firstname'],
            lastname: (string) $row['lastname'],
            email: (string) $row['email'],
            password: (string) $row['password'],
            phone: (string) $row['phone'],
            role: (string) ($row['role'] ?? 'user'),
            createdAt: $createdAt
        );

        $user->setId((int) $row['id']);

        return $user;
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM users";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }
}
