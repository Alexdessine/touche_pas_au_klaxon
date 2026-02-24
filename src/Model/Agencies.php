<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

class Agencies
{
    private ?int $id = null;
    private string $name;
    private DateTimeImmutable $createdAt;

    public function __construct(
        string $name,
        ?DateTimeImmutable $createdAt = null
    ) {
        $this->name = $name;
        $this->createdAt = $createdAt ?? new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    
}