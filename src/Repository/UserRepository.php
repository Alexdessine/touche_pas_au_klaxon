<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\User;
use DateTimeImmutable;
use PDO;

/**
 * Repository pour la table "users".
 *
 * Fournit des méthodes pour trouver, créer, mettre à jour et supprimer des utilisateurs.
 */
final class UserRepository
{
    /**
     * @param PDO $pdo Connexion PDO configurée (exceptions, charset, etc.)
     */
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * Retourne un utilisateur par son identifiant.
     *
     * @param int $id Identifiant de l'utilisateur
     * @return User|null L'utilisateur trouvé, sinon null
     */
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

    /**
    * Retourne un utilisateur par son adresse email.
    *
    * @param string $email Adresse email de l'utilisateur
    * @return User|null L'utilisateur trouvé, sinon null
    */
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
     * Retourne tous les utilisateurs (sauf les administrateurs).
     *
     * @return User[] Liste d'utilisateurs hydratés
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
     * Hydrate un objet {@see User} à partir d'une ligne SQL.
     *
     * @param array<string, mixed> $row Ligne issue d'un fetch(PDO::FETCH_ASSOC)
     * @return User Utilisateur hydraté
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

    /**
    * Retourne le nombre total d'utilisateurs en base de données.
    *
    * @return int Nombre total d'utilisateurs
    */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM users";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }
}
