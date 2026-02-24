<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Trips;
use DateTimeImmutable;  
use PDO;

/**
 * Accès aux données des trajets (table `trips`).
 *
 * Cette classe contient uniquement des opérations SQL (via PDO)
 * et retourne des objets métier {@see Trips}.
 *
 * Responsabilités principales :
 * - Lire les trajets futurs avec places disponibles
 * - Lire un trajet par identifiant
 * - Créer / mettre à jour / supprimer un trajet
 * - Vérifier l'existence de doublons (création / mise à jour)
 */
final class TripRepository
{
    /**
     * @param PDO $pdo Connexion PDO configurée (exceptions, charset, etc.)
     */
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * Retourne les trajets futurs ayant encore des places disponibles,
     * triés par date de départ croissante.
     *
     * @return list<Trips> Liste de trajets hydratés
     */
    public function findAll(): array
    {
        $sql = "SELECT id, user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats
                FROM trips
                WHERE departure_time >= NOW() AND available_seats > 0
                ORDER BY departure_time ASC";

        $stmt = $this->pdo->query($sql);

        /** @var list<Trips> $trips */
        $trips = [];
        while ($row = $stmt->fetch()) {
            $trips[] = $this->hydrateTrip($row);
        }

        return $trips;
    }

    /**
     * Retourne un trajet par son identifiant.
     *
     * @param int $id Identifiant du trajet
     * @return Trips|null Le trajet trouvé, sinon null
     */
    public function findById(int $id): ?Trips
    {
        $sql = "SELECT id, user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats
                FROM trips
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        /** @var array<string, mixed>|false $row */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }

        return $this->hydrateTrip($row);
    }

    /**
     * Indique si un trajet identique existe déjà (départ/arrivée/horaires).
     *
     * @param int $departureAgencyId Identifiant de l'agence de départ
     * @param int $arrivalAgencyId Identifiant de l'agence d'arrivée
     * @param DateTimeImmutable $departureTime Date/heure de départ
     * @param DateTimeImmutable $arrivalTime Date/heure d'arrivée
     * @return bool True si un doublon existe, sinon false
     */
    public function existsDuplicate(
        int $departureAgencyId,
        int $arrivalAgencyId,
        \DateTimeImmutable $departureTime,
        \DateTimeImmutable $arrivalTime
    ): bool {
        $sql = "SELECT 1
                FROM trips
                WHERE departure_agency_id = :departure_agency_id
                  AND arrival_agency_id = :arrival_agency_id
                  AND departure_time = :departure_time
                  AND arrival_time = :arrival_time
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':departure_agency_id' => $departureAgencyId,
            ':arrival_agency_id' => $arrivalAgencyId,
            ':departure_time' => $departureTime->format('Y-m-d H:i:s'),
            ':arrival_time' => $arrivalTime->format('Y-m-d H:i:s'),
        ]);
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Crée un nouveau trajet en base de données.
     *
     * @param Trips $trip Objet trajet à persister
     * @return int Identifiant du trajet créé
     */
    public function create(Trips $trip): int
    {
        $sql = "INSERT INTO trips
                (user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats)
                VALUES
                (:user_id, :departure_agency_id, :arrival_agency_id, :departure_time, :arrival_time, :available_seats)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':user_id'             => $trip->getUserId(),
            ':departure_agency_id' => $trip->getDepartureAgencyId(),
            ':arrival_agency_id'   => $trip->getArrivalAgencyId(),
            ':departure_time'      => $trip->getDepartureTime()->format('Y-m-d H:i:s'),
            ':arrival_time'        => $trip->getArrivalTime()->format('Y-m-d H:i:s'),
            ':available_seats'     => $trip->getAvailableSeats(),
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Met à jour un trajet existant en base de données.
     *
     * @param Trips $trip Trajet à mettre à jour (doit contenir un id)
     * @return void
     */
    public function update(Trips $trip): void
    {
        $sql = "UPDATE trips
                SET departure_agency_id = :departure_agency_id,
                    arrival_agency_id = :arrival_agency_id,
                    departure_time = :departure_time,
                    arrival_time = :arrival_time,
                    available_seats = :available_seats
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':departure_agency_id' => $trip->getDepartureAgencyId(),
            ':arrival_agency_id'   => $trip->getArrivalAgencyId(),
            ':departure_time'      => $trip->getDepartureTime()->format('Y-m-d H:i:s'),
            ':arrival_time'        => $trip->getArrivalTime()->format('Y-m-d H:i:s'),
            ':available_seats'     => $trip->getAvailableSeats(),
            ':id'                  => (int)$trip->getId(),
        ]);
    }

    /**
     * Indique si un trajet identique existe déjà, en excluant un identifiant
     * (utile lors d'une modification).
     *
     * @param int $excludeId Identifiant du trajet à exclure de la recherche
     * @param int $departureAgencyId Identifiant de l'agence de départ
     * @param int $arrivalAgencyId Identifiant de l'agence d'arrivée
     * @param DateTimeImmutable $departureTime Date/heure de départ
     * @param DateTimeImmutable $arrivalTime Date/heure d'arrivée
     * @return bool True si un doublon existe, sinon false
     */
    public function existsDuplicateExcludingId(
        int $excludeId,
        int $departureAgencyId,
        int $arrivalAgencyId,
        \DateTimeImmutable $departureTime,
        \DateTimeImmutable $arrivalTime
    ): bool {
        $sql = "SELECT 1
                FROM trips
                WHERE id <> :exclude_id
                AND departure_agency_id = :departure_agency_id
                AND arrival_agency_id = :arrival_agency_id
                AND departure_time = :departure_time
                AND arrival_time = :arrival_time
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':exclude_id' => $excludeId,
            ':departure_agency_id' => $departureAgencyId,
            ':arrival_agency_id' => $arrivalAgencyId,
            ':departure_time' => $departureTime->format('Y-m-d H:i:s'),
            ':arrival_time' => $arrivalTime->format('Y-m-d H:i:s'),
        ]);

        return (bool)$stmt->fetchColumn();
    }

    /**
     * Hydrate un objet {@see Trips} à partir d'une ligne SQL.
     *
     * @param array<string, mixed> $data Ligne issue d'un fetch(PDO::FETCH_ASSOC)
     * @return Trips Trajet hydraté
     */
    private function hydrateTrip(array $data): Trips
    {
        $trip = new Trips(
            userId: (int) $data['user_id'],
            departureAgencyId: (int) $data['departure_agency_id'],
            arrivalAgencyId: (int) $data['arrival_agency_id'],
            departureTime: new DateTimeImmutable($data['departure_time']),
            arrivalTime: new DateTimeImmutable($data['arrival_time']),
            availableSeats: (int) $data['available_seats']
        );
        $trip->setId((int) $data['id']);
        return $trip;
    }

    /**
     * Supprime un trajet par identifiant.
     *
     * @param int $id Identifiant du trajet à supprimer
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM trips WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    /**
     * Retourne le nombre total de trajets en base de données.
     *
     * @return int Nombre total de trajets
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM trips";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }
}
