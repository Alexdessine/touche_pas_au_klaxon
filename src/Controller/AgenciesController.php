<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\BaseController;
use App\Core\View;

final class AgenciesController extends BaseController
{
    public function index(): void
    {
        $this->requireAuth();
        $this->requireAdmin();

        View::render('agencies/index', [
            'title' => 'Agences - Touche Pas au Klaxon',
        ]);
    }

    public function create(): void
    {
        $this->requireAuth();
        $this->requireAdmin();


        View::render('agencies/create', [
            'title' => 'Créer une agence - Touche Pas au Klaxon',
            'submitTitle' => 'Ajouter une agence',
            'submitLabel' => 'Ajouter l\'agence'
        ]);
    }

    public function store(): void
    {
        $this->requireAuth();
        $this->requireAdmin();

        // Logique de création de l'agence

        View::render('agencies/index', [
            'alert' => 'Agence ajoutée avec succès.',
            'messageType' => 'success',
            'title' => 'Agences - Touche Pas au Klaxon',
        ]);
    }

    public function edit(): void
    {
        $this->requireAuth();
        $this->requireAdmin();
        

        View::render('agencies/edit', [
            'title' => 'Modifier une agence - Touche Pas au Klaxon',
            'submitTitle' => 'Modifier une agence',
            'submitLabel' => 'Modifier l\'agence',
            'action' => '/agences/edit'
        ]);
    }

    public function update(): void
    {
        $this->requireAuth();
        $this->requireAdmin();

        // Logique de mise à jour de l'agence

        View::render('agencies/index', [
            'alert' => 'Agence modifiée avec succès.',
            'messageType' => 'success',
            'title' => 'Agences - Touche Pas au Klaxon',
        ]);
    }

    public function delete(): void
    {
        $this->requireAuth();
        $this->requireAdmin();

        // Logique de suppression de l'agence

        View::render('agencies/index', [
            'alert' => 'Agence supprimée avec succès.',
            'messageType' => 'success',
            'title' => 'Agences - Touche Pas au Klaxon',
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
