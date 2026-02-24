<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Agencies;
use DateTimeImmutable;
use PDO;

final class AgenciesRepository
{
    public function __construct(private PDO $pdo)
    {
    }

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
     * @return Agencies[]
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

    private function hydrateAgencies(array $data): Agencies
    {
        $agencies = new Agencies(
            name: (string) $data['name'],
            createdAt: new DateTimeImmutable($data['created_at'])
        );
        $agencies->setId((int) $data['id']);
        return $agencies;
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM agencies";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }

    public function create(string $name): int
    {
        $sql = "INSERT INTO agencies (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, string $name): void
    {
        $sql = "UPDATE agencies SET name = :name WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM agencies WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

}