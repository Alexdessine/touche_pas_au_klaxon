<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

/**
 * Représente un utilisateur de l'application.
 */
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

    /**
    * @param string $firstname Le prénom de l'utilisateur
    * @param string $lastname Le nom de famille de l'utilisateur
    * @param string $email L'adresse email de l'utilisateur
    * @param string $password Le mot de passe hashé de l'utilisateur
    * @param string $phone Le numéro de téléphone de l'utilisateur
    * @param string $role Le rôle de l'utilisateur (par défaut 'user')
    * @param DateTimeImmutable|null $createdAt La date de création du compte (optionnelle, par défaut à la date actuelle)
    */
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

    /**     
     * @return int|null L'identifiant de l'utilisateur
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id L'identifiant de l'utilisateur
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string Le prénom de l'utilisateur
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string Le nom de famille de l'utilisateur
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string L'adresse email de l'utilisateur
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string Le mot de passe hashé de l'utilisateur
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string Le numéro de téléphone de l'utilisateur
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string Le rôle de l'utilisateur
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return DateTimeImmutable La date de création du compte
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
