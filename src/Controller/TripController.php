<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\BaseController;
use App\Core\View;

final class TripController extends BaseController
{
    public function index(): void
    {
        $this->requireAuth();

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
        $this->requireAuth();

        View::render('trip/create', [
            'title' => 'Trajets - Touche Pas au Klaxon',
            'alert' => 'Trajet ajouté avec succès',
            'messageType' => 'success',
            'action' => '/trajets/ajouter',
            'trip'=> $trip ?? []
        ]);
    }

    public function store(): void
    {
        $this->requireAuth();

        // Ici, vous ajouteriez la logique pour enregistrer le trajet dans la base de données
        // Par exemple : Trip::create($_POST['data']);

        // Rediriger vers la liste des trajets après l'ajout
        View::render('trip/index', [
            'title' => 'Trajets - Touche Pas au Klaxon',
            'alert' => 'Trajet ajouté avec succès',
            'messageType' => 'success'
        ]);
    }

    public function edit(): void
    {
        $this->requireAuth();

        View::render('trip/edit', [
            'title' => 'Modifier un trajet - Touche Pas au Klaxon',
            'submitLabel' => 'Modifier le trajet',
            'action' => '/trajets/edit',
            'trip'=> $trip ?? []
        ]);
    }

    public function update(): void
    {
        $this->requireAuth();

        // Ici, vous ajouteriez la logique pour mettre à jour le trajet dans la base de données
        // Par exemple : Trip::update($_POST['id'], $_POST['data']);

        // Rediriger vers la liste des trajets après la mise à jour
        View::render('trip/index', [
            'title' => 'Trajets - Touche Pas au Klaxon',
            'alert' => 'Trajet modifié avec succès',
            'messageType' => 'success'
        ]);
    }

    public function delete(): void
    {
        $this->requireAuth();

        // Ici, vous ajouteriez la logique pour supprimer le trajet de la base de données
        // Par exemple : Trip::delete($_POST['id']);

        // Rediriger vers la liste des trajets après la suppression
        View::render('trip/index', [
            'title' => 'Trajets - Touche Pas au Klaxon',
            'alert' => 'Trajet supprimé avec succès',
            'messageType' => 'success'
        ]);
    }
}
