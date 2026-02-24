<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Auth;


/**
 * Classe de base pour tous les contrôleurs.
 * Fournit des méthodes utilitaires pour la gestion de l'authentification et des autorisations.
 */
abstract class BaseController
{
    /**
     * Vérifie si un utilisateur est connecté. Si ce n'est pas le cas, redirige vers la page de connexion.
     *
     * @return void
     */
    protected function requireAuth(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Vérifie si l'utilisateur connecté est un administrateur. Si ce n'est pas le cas, affiche une page d'erreur 403.
     *
     * @return void
     */
    protected function requireAdmin(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if (!Auth::isAdmin()) {
            http_response_code(403);
            echo 'Accès interdit';
            exit;
        }
    }

    /**
     * Vérifie si l'utilisateur connecté est un utilisateur standard. Si ce n'est pas le cas, affiche une page d'erreur 403.
     *
     * @return void
     */
    protected function requireUser(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if (!Auth::isUser()) {
            http_response_code(403);
            echo 'Accès interdit';
            exit;
        }
    }
}
