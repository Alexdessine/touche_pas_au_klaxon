<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;

/**
 * Contrôleur pour la page d'administration du tableau de bord.
 */
final class AdminDashboardController
{
    /**
     * Affiche le tableau de bord de l'administration.
     *
     * @return void
     */
    public function index(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        View::render('admin/dashboard', [
            'title' => 'Administration - Touche Pas au Klaxon',
            'user' => Auth::user()
        ]);
    }
}
