<?php

declare(strict_types=1);

namespace App\Core;

use App\Repository\UserRepository;

final class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user']) && is_array($_SESSION['user']);
    }

    public static function user(): ?array
    {
        return self::check() ? $_SESSION['user'] : null;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    public static function attempt(UserRepository $users, string $email, string $password): bool
    {
        $user = $users->findByEmail($email);

        if ($user === null) {
            return false;
        }

        // Dans ta BDD tu sélectionnes "password", donc ici on récupère ce champ via l'objet.
        $hash = $user->getPassword();

        if ($hash === '' || !password_verify($password, $hash)) {
            return false;
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'role' => $user->getRole(),
        ];

        return true;
    }

    public static function isAdmin(): bool
    {
        return self::check() && ($_SESSION['user']['role'] ?? null) === 'admin';
    }

    public static function isUser(): bool
    {
        return self::check() && (($_SESSION['user']['role'] ?? null) === 'user');
    }
}