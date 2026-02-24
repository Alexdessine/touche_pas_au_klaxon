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

        $pdo = \App\Core\Connection::getPdo();
        $agenciesRepo = new \App\Repository\AgenciesRepository($pdo);
        $agencies = $agenciesRepo->findAll();

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        View::render('agencies/index', [
            'title' => 'Agences - Touche Pas au Klaxon',
            'agencies' => $agencies,
            'alert' => $flash['alert'] ?? null,
            'messageType' => $flash['messageType'] ?? null,
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

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            View::render('errors/405', ['title' => 'Méthode non autorisée']);
            return;
        }

        $name = trim((string)($_POST['name'] ?? ''));

        $errors = [];
        if ($name === '') {
            $errors['name'] = 'Le nom de l\'agence est requis.';
        } elseif (mb_strlen($name) > 190) {
            $errors['name'] = 'Le nom de l\'agence ne doit pas dépasser 190 caractères.';
        }

        if (!empty($errors)) {
            View::render('agencies/create', [
                'title' => 'Créer une agence - Touche Pas au Klaxon',
                'submitTitle' => 'Ajouter une agence',
                'submitLabel' => 'Ajouter l\'agence',
                'action' => '/agences/ajouter',
                'errors' => $errors,
                'agency' => ['name' => $name],
                'messageType' => 'danger',
                'alert' => 'Veuillez corriger les erreurs dans le formulaire.',
            ]);
            return;
        }

        $pdo = \App\Core\Connection::getPdo();
        $repo = new \App\Repository\AgenciesRepository($pdo);

        try{
            $repo->create($name);
        }catch (\PDOException $e) {
            error_log((string) $e);
            $errors['name'] = "Le champ renseigné n'est pas correct";
            View::render('agencies/create', [
                'title' => 'Créer une agence - Touche Pas au Klaxon',
                'submitTitle' => 'Ajouter une agence',
                'submitLabel' => 'Ajouter l\'agence',
                'action' => '/agences/ajouter',
                'errors' => ['Une erreur est survenue lors de la création de l\'agence. Veuillez réessayer.'],
                'agency' => ['name' => $name],
                'messageType' => 'danger',
                'alert' => 'Une erreur est survenue lors de la création de l\'agence. Veuillez réessayer.',
            ]);
            return;
        }

        $_SESSION['flash'] = [
            'messageType' => 'success',
            'alert' => 'Agence créée avec succès.',
        ];
        header('Location: /agences');
        exit;
    }

    public function edit(int $id): void
    {
        $this->requireAuth();
        $this->requireAdmin();

        $pdo = \App\Core\Connection::getPdo();
        $repo = new \App\Repository\AgenciesRepository($pdo);

        $agency = $repo->findById($id);

        if (!$agency) {
            http_response_code(404);
            View::render('errors/404', ['title' => 'Agence introuvable']);
            return;
        }

        View::render('agencies/edit', [
            'title' => 'Modifier une agence',
            'submitTitle' => 'Modifier une agence',
            'submitLabel' => 'Modifier',
            'action' => "/agences/{$id}/edit",
            'agency' => [
                'id' => $agency->getId(),
                'name' => $agency->getName(),
            ],
        ]);
    }


    public function update(int $id): void
    {
        $this->requireAuth();
        $this->requireAdmin();

        $name = trim((string)($_POST['name'] ?? ''));

        $errors = [];
        if ($name === '') {
            $errors['name'] = 'Le nom de l\'agence est requis.';
        } elseif (mb_strlen($name) > 190) {
            $errors['name'] = 'Le nom de l\'agence ne doit pas dépasser 190 caractères.';
        }

        if (!empty($errors)) {
            View::render('agencies/edit', [
                'title' => 'Modifier une agence - Touche Pas au Klaxon',
                'submitTitle' => 'Modifier une agence',
                'submitLabel' => 'Modifier',
                'action' => "/agences/{$id}/edit",
                'errors' => $errors,
                'agency' => ['name' => $name],
                'messageType' => 'danger',
                'alert' => 'Veuillez corriger les erreurs dans le formulaire.',
            ]);
            return;
        }

        $pdo = \App\Core\Connection::getPdo();
        $repo = new \App\Repository\AgenciesRepository($pdo);

        try {
            $repo->update($id, $name);
            } catch (\PDOException $e) {
                error_log((string)$e);

                View::render('agencies/edit', [
                    'title' => 'Modifier une agence',
                    'submitTitle' => 'Modifier une agence',
                    'submitLabel' => 'Modifier',
                    'action' => "/agences/{$id}/edit",
                    'agency' => ['id' => $id, 'name' => $name],
                    'errors' => ['name' => "Cette agence existe déjà (ou erreur SQL)."],
                    'messageType' => 'danger',
                    'alert' => "Une erreur est survenue lors de la mise à jour.",
                ]);
                return;
        }

        $_SESSION['flash'] = [
            'messageType' => 'success',
            'alert' => 'Agence modifiée avec succès.',
        ];

        header('Location: /agences');
        exit;
    }


    public function delete(): void
    {
        $this->requireAuth();
        $this->requireAdmin();

        // Logique de suppression de l'agence
        $id = (int)($_POST['id'] ?? 0);

        $pdo = \App\Core\Connection::getPdo();
        $repo = new \App\Repository\AgenciesRepository($pdo);
        $repo->delete($id);

        $_SESSION['flash'] = [
            'messageType' => 'success',
            'alert' => 'Agence supprimée avec succès.',
        ];

        header('Location: /agences');
        exit;
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
