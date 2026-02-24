<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

class User
{
    private ?int $id = null;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $phone;
    private string $role;
    private DateTimeImmutable $createdAt;

    public function __construct(
        string $firstname,
        string $lastname,
        string $email,
        string $password,
        string $phone,
        string $role = 'user',
        ?DateTimeImmutable $createdAt = null
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->role = $role;
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

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
