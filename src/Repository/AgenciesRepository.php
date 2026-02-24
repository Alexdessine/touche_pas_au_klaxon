<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Agencies;
use DateTimeImmutable;
use PDO;

/**
 * Repository pour la table "agencies".
 *
 * Cette classe contient uniquement des opérations SQL (via PDO)
 * et retourne des objets métier {@see Agencies}.
 *
 * Responsabilités principales :
 * - Lire toutes les agences
 * - Lire une agence par identifiant
 * - Créer / mettre à jour / supprimer une agence
 * - Compter le nombre total d'agences
 */
final class AgenciesRepository
{
    /**
     * @param PDO $pdo Connexion PDO configurée (exceptions, charset, etc.)
     */
    public function __construct(private PDO $pdo)
    {
    }

    /**
    * Retourne une agence par son identifiant.
    *
    * @param int $id Identifiant de l'agence
    * @return Agencies|null L'agence trouvée, sinon null
    */
    public function findById(int $id): ?Agencies
    {
        $sql = "SELECT id, name, created_at
                FROM agencies
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ? $this->hydrateAgencies($row) : null;
    }

    /**
     * Retourne toutes les agences.
     *
     * @return Agencies[] Liste d'agences hydratées
     */
    public function findAll(): array
    {
        $sql = "SELECT id, name, created_at
                FROM agencies
                ORDER BY name ASC";

        $stmt = $this->pdo->query($sql);

        $agencies = [];
        while ($row = $stmt->fetch()) {
            $agencies[] = $this->hydrateAgencies($row);
        }

        return $agencies;
    }

    /**
     * Hydrate un objet {@see Agencies} à partir d'une ligne SQL.
     *
     * @param array<string, mixed> $data Ligne issue d'un fetch(PDO::FETCH_ASSOC)
     * @return Agencies Agence hydratée
     */
    private function hydrateAgencies(array $data): Agencies
    {
        $agencies = new Agencies(
            name: (string) $data['name'],
            createdAt: new DateTimeImmutable($data['created_at'])
        );
        $agencies->setId((int) $data['id']);
        return $agencies;
    }

    /**
     * Retourne le nombre total d'agences en base de données.
     *
     * @return int Nombre total d'agences
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM agencies";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }

    /**
     * Crée une nouvelle agence en base de données.
     *
     * @param string $name Nom de l'agence
     * @return int Identifiant de l'agence créée
     */
    public function create(string $name): int
    {
        $sql = "INSERT INTO agencies (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Met à jour une agence existante en base de données.
     *
     * @param int $id Identifiant de l'agence à mettre à jour
     * @param string $name Nouveau nom de l'agence
     * @return void
     */
    public function update(int $id, string $name): void
    {
        $sql = "UPDATE agencies SET name = :name WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }

    /**
    * Supprime une agence par identifiant.
    *
    * @param int $id Identifiant de l'agence à supprimer
    * @return void
    */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM agencies WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

}