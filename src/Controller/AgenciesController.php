<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;

final class AgenciesController
{
    public function index(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if (!Auth::isAdmin()) {
            header('Location: /');
            exit;
        }

        View::render('agencies/index', [
            'title' => 'Agences - Touche Pas au Klaxon',
        ]);
    }

    public function create(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if (!Auth::isAdmin()) {
            header('Location: /');
            exit;
        }

        View::render('agencies/create', [
            'title' => 'Créer une agence - Touche Pas au Klaxon',
            'submitTitle' => 'Ajouter une agence',
            'submitLabel' => 'Ajouter l\'agence'
        ]);
    }

    public function edit(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if (!Auth::isAdmin()) {
            header('Location: /');
            exit;
        }

        View::render('agencies/edit', [
            'title' => 'Modifier une agence - Touche Pas au Klaxon',
            'submitTitle' => 'Modifier une agence',
            'submitLabel' => 'Modifier l\'agence'
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
