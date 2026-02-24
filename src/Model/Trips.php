<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;


class Trips
{
    private ?int $id = null;
    private int $userId;
    private int $departureAgencyId;
    private int $arrivalAgencyId;
    private DateTimeImmutable $departureTime;
    private DateTimeImmutable $arrivalTime;
    private int $availableSeats;

    public function __construct(
        int $userId,
        int $departureAgencyId,
        int $arrivalAgencyId,
        DateTimeImmutable $departureTime,
        DateTimeImmutable $arrivalTime,
        int $availableSeats
    ) {
        $this->userId = $userId;
        $this->departureAgencyId = $departureAgencyId;
        $this->arrivalAgencyId = $arrivalAgencyId;
        $this->departureTime = $departureTime;
        $this->arrivalTime = $arrivalTime;
        $this->availableSeats = $availableSeats;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getDepartureAgencyId(): int
    {
        return $this->departureAgencyId;
    }

    public function getArrivalAgencyId(): int   
    {
        return $this->arrivalAgencyId;
    }

    public function getDepartureTime(): DateTimeImmutable
    {
        return $this->departureTime;
    }

    public function getArrivalTime(): DateTimeImmutable
    {
        return $this->arrivalTime;
    }

    public function getAvailableSeats(): int
    {
        return $this->availableSeats;
    }
}