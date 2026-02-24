<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

/**
 * Représente un trajet de transport.
 */
class Trips
{
    private ?int $id = null;
    private int $userId;
    private int $departureAgencyId;
    private int $arrivalAgencyId;
    private DateTimeImmutable $departureTime;
    private DateTimeImmutable $arrivalTime;
    private int $availableSeats;

    /**
     * @param int $userId Identifiant de l'utilisateur qui crée le trajet
     * @param int $departureAgencyId Identifiant de l'agence de départ
     * @param int $arrivalAgencyId Identifiant de l'agence d'arrivée
     * @param DateTimeImmutable $departureTime Date et heure de départ
     * @param DateTimeImmutable $arrivalTime Date et heure d'arrivée
     * @param int $availableSeats Nombre de places disponibles
     */
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

    /**
     * @return int|null L'identifiant du trajet
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id L'identifiant du trajet
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int L'identifiant de l'utilisateur qui crée le trajet
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int L'identifiant de l'agence de départ
     */
    public function getDepartureAgencyId(): int
    {
        return $this->departureAgencyId;
    }

    /**
     * @return int L'identifiant de l'agence d'arrivée
     */
    public function getArrivalAgencyId(): int   
    {
        return $this->arrivalAgencyId;
    }

    /**
     * @return DateTimeImmutable La date et l'heure de départ
     */
    public function getDepartureTime(): DateTimeImmutable
    {
        return $this->departureTime;
    }

    /**
     * @return DateTimeImmutable La date et l'heure d'arrivée
     */
    public function getArrivalTime(): DateTimeImmutable
    {
        return $this->arrivalTime;
    }

    /**
     * @return int Le nombre de places disponibles
     */
    public function getAvailableSeats(): int
    {
        return $this->availableSeats;
    }
}