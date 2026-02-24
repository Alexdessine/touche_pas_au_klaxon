<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Trips;
use DateTimeImmutable;  
use PDO;


final class TripRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @return Trips[]
     */
    public function findAll(): array
    {
        $sql = "SELECT id, user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats
                FROM trips
                WHERE departure_time >= NOW() AND available_seats > 0
                ORDER BY departure_time ASC";

        $stmt = $this->pdo->query($sql);

        $trips = [];
        while ($row = $stmt->fetch()) {
            $trips[] = $this->hydrateTrip($row);
        }

        return $trips;
    }

    public function findById(int $id): ?Trips
    {
        $sql = "SELECT id, user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats
                FROM trips
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }

        return $this->hydrateTrip($row);
    }

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

    public function delete(int $id): void
    {
        $sql = "DELETE FROM trips WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM trips";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }
}
