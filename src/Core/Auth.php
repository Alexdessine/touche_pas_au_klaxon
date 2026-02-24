<?php

declare(strict_types=1);

namespace App\Core;

use App\Repository\UserRepository;

/**
 * Classe d'authentification pour gérer les sessions utilisateur, les tentatives de connexion, et les vérifications de rôles.
 */
final class Auth
{
    /**
    * Vérifie si un utilisateur est actuellement connecté.
    *
    * @return bool Vrai si un utilisateur est connecté, sinon faux.
    */
    public static function check(): bool
    {
        return isset($_SESSION['user']) && is_array($_SESSION['user']);
    }

    /**
     * @return array{
     *   id:int,
     *   firstname:string,
     *   lastname:string,
     *   email:string,
     *   phone:string,
     *   role:string
     * }|null
     */
    public static function user(): ?array
    {
        return self::check() ? $_SESSION['user'] : null;
    }

    /**
     * Déconnecte l'utilisateur en supprimant les données de session et en régénérant l'ID de session pour éviter les attaques de fixation de session.
     *
     * @return void
     */
    public static function logout(): void
    {
        unset($_SESSION['user']);

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    /**
    * Tente de connecter un utilisateur avec l'email et le mot de passe fournis.
    * Si la connexion est réussie, les informations de l'utilisateur sont stockées dans la session.
    *
    * @param UserRepository $users Le repository pour accéder aux données des utilisateurs
    * @param string $email L'email de l'utilisateur
    * @param string $password Le mot de passe de l'utilisateur
    * @return bool Vrai si la connexion est réussie, sinon faux
    */
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

    /**
     * Vérifie si l'utilisateur connecté est un administrateur.
     *
     * @return bool Vrai si l'utilisateur est un administrateur, sinon faux.
     */
    public static function isAdmin(): bool
    {
        return self::check() && ($_SESSION['user']['role'] ?? null) === 'admin';
    }

    /**
     * Vérifie si l'utilisateur connecté est un utilisateur standard.
     *
     * @return bool Vrai si l'utilisateur est un utilisateur standard, sinon faux.
     */
    public static function isUser(): bool
    {
        return self::check() && (($_SESSION['user']['role'] ?? null) === 'user');
    }
}