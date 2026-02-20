<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;

final class TripController
{
    public function index(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        View::render('trip/index', [
            'title' => 'Trajets - Touche Pas au Klaxon',
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }

    public function create(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        View::render('trip/create', [
            'title' => 'Créer un trajet - Touche Pas au Klaxon',
            'submitLabel' => 'Ajouter le trajet'
        ]);
    }

    public function edit(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        View::render('trip/edit', [
            'title' => 'Modifier un trajet - Touche Pas au Klaxon',
            'submitLabel' => 'Modifier le trajet'
        ]);
    }
}
