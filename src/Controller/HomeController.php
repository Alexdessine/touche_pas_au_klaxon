<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Repository\AgenciesRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

/**
 * Contrôleur pour la page d'accueil.
 */
final class HomeController
{
    /**
     * Affiche la page d'accueil avec les informations des voyages, agences et utilisateurs.
     *
     * @return void
     */
    public function index(): void
    {
        $pdo = \App\Core\Connection::getPdo();

        $tripRepo = new TripRepository($pdo);
        $trips = $tripRepo->findAll();

        $agenciesRepo = new AgenciesRepository($pdo);
        $agencies = $agenciesRepo->findAll();

        $userRepo = new UserRepository($pdo);
        $currentUserId = $userRepo->findAll();

        // Map id -> name pour afficher Paris/Lyon etc.
        $agencyNamesById = [];
        foreach ($agencies as $agency) {
            $agencyNamesById[(int)$agency->getId()] = (string)$agency->getName();
        }

        $userNamesById = [];
        $userPhoneById = [];
        $userEmailById = [];
        foreach ($currentUserId as $user) {
            $userNamesById[(int)$user->getId()] = (string)$user->getFirstname() . ' ' . (string)$user->getLastname();
            $userPhoneById[(int)$user->getId()] = (string)$user->getPhone();
            $userEmailById[(int)$user->getId()] = (string)$user->getEmail();
        }

        
        $alert = $_SESSION['alert'] ?? null;
        $messageType = $_SESSION['messageType'] ?? 'info';
        unset($_SESSION['alert'], $_SESSION['messageType']);

        View::render('home/index', [
            'title' => 'Accueil - Touche Pas au Klaxon',
            'trips' => $trips,
            'agencyNamesById' => $agencyNamesById,
            'alert' => $alert,
            'messageType' => $messageType,
            'userNamesById' => $userNamesById,
            'userPhoneById' => $userPhoneById,
            'userEmailById' => $userEmailById,
        ]);
    }
}
