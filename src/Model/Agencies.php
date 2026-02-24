<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

/**
 * Représente une agence de transport.
 */
class Agencies
{
    private ?int $id = null;
    private string $name;
    private DateTimeImmutable $createdAt;

    /**
     * @param string $name Le nom de l'agence
     * @param DateTimeImmutable|null $createdAt La date de création de l'agence (optionnelle, par défaut à la date actuelle)
     */
    public function __construct(
        string $name,
        ?DateTimeImmutable $createdAt = null
    ) {
        $this->name = $name;
        $this->createdAt = $createdAt ?? new DateTimeImmutable();
    }

    /**
     * Getters et setters
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string Le nom de l'agence
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTimeImmutable La date de création de l'agence
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param string $name Le nom de l'agence
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param DateTimeImmutable $createdAt La date de création de l'agence
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    
}