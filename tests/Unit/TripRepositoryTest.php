<?php

declare(strict_types=1);

use App\Model\Trips;
use App\Repository\TripRepository;
use DateTimeImmutable;
use PDO;
use PDOStatement;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TripRepository::class)]
final class TripRepositoryTest extends TestCase
{
    public function testCreateInsertsTripAndReturnsLastInsertId(): void
    {
        $trip = new Trips(
            userId: 42,
            departureAgencyId: 1,
            arrivalAgencyId: 2,
            departureTime: new DateTimeImmutable('2026-03-01 08:00:00'),
            arrivalTime: new DateTimeImmutable('2026-03-01 10:00:00'),
            availableSeats: 3
        );

        $expectedSql = "INSERT INTO trips
                (user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats)
                VALUES
                (:user_id, :departure_agency_id, :arrival_agency_id, :departure_time, :arrival_time, :available_seats)";

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with([
                ':user_id'             => 42,
                ':departure_agency_id' => 1,
                ':arrival_agency_id'   => 2,
                ':departure_time'      => '2026-03-01 08:00:00',
                ':arrival_time'        => '2026-03-01 10:00:00',
                ':available_seats'     => 3,
            ])
            ->willReturn(true);

        $pdo = $this->createMock(PDO::class);
        $pdo->expects($this->once())
            ->method('prepare')
            ->with($expectedSql)
            ->willReturn($stmt);

        $pdo->expects($this->once())
            ->method('lastInsertId')
            ->willReturn('123');

        $repo = new TripRepository($pdo);

        $id = $repo->create($trip);

        $this->assertSame(123, $id);
    }

    public function testUpdateExecutesUpdateWithExpectedParameters(): void
    {
        $trip = new Trips(
            userId: 42,
            departureAgencyId: 10,
            arrivalAgencyId: 20,
            departureTime: new DateTimeImmutable('2026-03-02 09:00:00'),
            arrivalTime: new DateTimeImmutable('2026-03-02 11:00:00'),
            availableSeats: 2
        );
        $trip->setId(777);

        $expectedSql = "UPDATE trips
                SET departure_agency_id = :departure_agency_id,
                    arrival_agency_id = :arrival_agency_id,
                    departure_time = :departure_time,
                    arrival_time = :arrival_time,
                    available_seats = :available_seats
                WHERE id = :id";

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with([
                ':departure_agency_id' => 10,
                ':arrival_agency_id'   => 20,
                ':departure_time'      => '2026-03-02 09:00:00',
                ':arrival_time'        => '2026-03-02 11:00:00',
                ':available_seats'     => 2,
                ':id'                  => 777,
            ])
            ->willReturn(true);

        $pdo = $this->createMock(PDO::class);
        $pdo->expects($this->once())
            ->method('prepare')
            ->with($expectedSql)
            ->willReturn($stmt);

        $repo = new TripRepository($pdo);

        // Méthode void : on vérifie par expectations sur PDOStatement::execute()
        $repo->update($trip);

        $this->assertTrue(true); // évite “risky test”
    }

    public function testDeleteExecutesDeleteWithExpectedParameterKey(): void
    {
        // Important : ton code fait execute(['id' => $id]) (sans ':')
        $expectedSql = "DELETE FROM trips WHERE id = :id";

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with(['id' => 9])
            ->willReturn(true);

        $pdo = $this->createMock(PDO::class);
        $pdo->expects($this->once())
            ->method('prepare')
            ->with($expectedSql)
            ->willReturn($stmt);

        $repo = new TripRepository($pdo);

        $repo->delete(9);

        $this->assertTrue(true);
    }

}