<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\BaseController;
use App\Core\View;
use App\Repository\AgenciesRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

final class TripController extends BaseController
{
    public function index(): void
    {
        $this->requireAuth();

        $pdo = \App\Core\Connection::getPdo();

        $tripRepo = new \App\Repository\TripRepository($pdo);
        $trips = $tripRepo->findAll();

        $agenciesRepo = new \App\Repository\AgenciesRepository($pdo);
        $agencies = $agenciesRepo->findAll();

        $userRepo = new UserRepository($pdo);
        $currentUserId = $userRepo->findAll();

        // Map id -> name pour afficher Paris/Lyon etc.
        $agencyNamesById = [];
        foreach ($agencies as $agency) {
            $agencyNamesById[(int)$agency->getId()] = (string)$agency->getName();
        }

        $userNamesById = [];
        foreach ($currentUserId as $user) {
            $userNamesById[(int)$user->getId()] = (string)$user->getFirstname() . ' ' . (string)$user->getLastname();
            $userPhoneById[(int)$user->getId()] = (string)$user->getPhone();
            $userEmailById[(int)$user->getId()] = (string)$user->getEmail();
        }

        // Ton système d’alert (si tu veux l’utiliser ici)
        $alert = $_SESSION['alert'] ?? null;
        $messageType = $_SESSION['messageType'] ?? 'info';
        unset($_SESSION['alert'], $_SESSION['messageType']);

        View::render('trip/index', [
            'title' => 'Trajets - Touche Pas au Klaxon',
            'trips' => $trips,
            'agencyNamesById' => $agencyNamesById,
            'alert' => $alert,
            'messageType' => $messageType,
            'userNamesById' => $userNamesById,
            'userPhoneById' => $userPhoneById,
            'userEmailById' => $userEmailById,
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

        $pdo = \App\Core\Connection::getPdo();

        $agenciesRepo = new AgenciesRepository($pdo);
        $agencies = $agenciesRepo->findAll();

        $userId = (int)($_SESSION['user']['id'] ?? 0);
        $userRepo = new UserRepository($pdo);
        $user = $userRepo->findById($userId);

        View::render('trip/create', [
            'title' => 'Ajouter un trajet - Touche Pas au Klaxon',
            'action' => '/trajets/ajouter',
            'agencies' => $agencies,
            'trip' => null,
            'errors' => [],
            'user' => $user, 
            'alert' => null,
            'messageType' => 'info',
        ]);
    }

    public function store(): void
    {
        $this->requireAuth();

        $pdo = \App\Core\Connection::getPdo();
        $agenciesRepo = new \App\Repository\AgenciesRepository($pdo);
        $tripRepo = new \App\Repository\TripRepository($pdo);
        $userRepo = new \App\Repository\UserRepository($pdo);

        // Utilisateur connecté (pour afficher ses infos dans la vue create)
        $sessionUserId = $_SESSION['user']['id'] ?? null;
        if (!is_int($sessionUserId) && !ctype_digit((string)$sessionUserId)) {
            http_response_code(403);
            exit('Accès refusé.');
        }
        $userId = (int)$sessionUserId;
        $user = $userRepo->findById($userId); // doit exister dans ton UserRepository

        // Lecture défensive
        $departureAgencyId = filter_input(INPUT_POST, 'departure_agency_id', FILTER_VALIDATE_INT);
        $arrivalAgencyId   = filter_input(INPUT_POST, 'arrival_agency_id', FILTER_VALIDATE_INT);

        $departureDate = (string)(filter_input(INPUT_POST, 'departure_date') ?? '');
        $departureTime = (string)(filter_input(INPUT_POST, 'departure_time') ?? '');
        $arrivalDate   = (string)(filter_input(INPUT_POST, 'arrival_date') ?? '');
        $arrivalTime   = (string)(filter_input(INPUT_POST, 'arrival_time') ?? '');

        $availableSeats = filter_input(INPUT_POST, 'available_seats', FILTER_VALIDATE_INT);

        $errors = [];

        // Requis
        if ($departureAgencyId === false || $departureAgencyId === null) {
            $errors['departure_agency_id'] = "L'agence de départ est obligatoire.";
        }
        if ($arrivalAgencyId === false || $arrivalAgencyId === null) {
            $errors['arrival_agency_id'] = "L'agence d'arrivée est obligatoire.";
        }

        if (trim($departureDate) === '') {
            $errors['departure_date'] = "La date de départ est obligatoire.";
        }
        if (trim($departureTime) === '') {
            $errors['departure_time'] = "L'heure de départ est obligatoire.";
        }
        if (trim($arrivalDate) === '') {
            $errors['arrival_date'] = "La date d'arrivée est obligatoire.";
        }
        if (trim($arrivalTime) === '') {
            $errors['arrival_time'] = "L'heure d'arrivée est obligatoire.";
        }

        if ($availableSeats === false || $availableSeats === null) {
            $errors['available_seats'] = "Le nombre de places disponibles est obligatoire.";
        }

        // Règle 1 : agences différentes
        if (
            !isset($errors['departure_agency_id'], $errors['arrival_agency_id'])
            && (int)$departureAgencyId === (int)$arrivalAgencyId
        ) {
            $errors['arrival_agency_id'] = "L'agence d'arrivée doit être différente de l'agence de départ.";
        }

        // Règle 3 : places > 0
        if (!isset($errors['available_seats']) && (int)$availableSeats <= 0) {
            $errors['available_seats'] = "Le nombre total de places doit être supérieur à 0.";
        }

        // Construire les DateTimeImmutable depuis <input type="date"> + <input type="time">
        $departureDT = null;
        $arrivalDT   = null;

        if (!isset($errors['departure_date'], $errors['departure_time'])) {
            $departureDT = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $departureDate . ' ' . $departureTime);
            if ($departureDT === false) {
                $errors['departure_date'] = "Date/heure de départ invalide.";
            }
        }

        if (!isset($errors['arrival_date'], $errors['arrival_time'])) {
            $arrivalDT = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $arrivalDate . ' ' . $arrivalTime);
            if ($arrivalDT === false) {
                $errors['arrival_date'] = "Date/heure d'arrivée invalide.";
            }
        }

        // Règle 2 : arrivée > départ
        if ($departureDT instanceof \DateTimeImmutable && $arrivalDT instanceof \DateTimeImmutable) {
            if ($arrivalDT <= $departureDT) {
                $errors['arrival_date'] = "La date/heure d'arrivée doit être supérieure à la date/heure de départ.";
            }
        }

        // Règle 4 : pas de doublon (même départ, même arrivée, mêmes dates/heures)
        if (
            empty($errors)
            && $departureDT instanceof \DateTimeImmutable
            && $arrivalDT instanceof \DateTimeImmutable
            && $tripRepo->existsDuplicate((int)$departureAgencyId, (int)$arrivalAgencyId, $departureDT, $arrivalDT)
        ) {
            $errors['form'] = "Un trajet identique existe déjà.";
        }

        // Préparer les données pour re-remplir le formulaire
        $tripFormData = [
            'departure_agency_id' => ($departureAgencyId === false ? null : $departureAgencyId),
            'arrival_agency_id'   => ($arrivalAgencyId === false ? null : $arrivalAgencyId),
            'departure_date'      => $departureDate,
            'departure_time'      => $departureTime,
            'arrival_date'        => $arrivalDate,
            'arrival_time'        => $arrivalTime,
            'available_seats'     => ($availableSeats === false ? null : $availableSeats),
        ];

        // Si erreurs -> re-render du formulaire
        if (!empty($errors)) {
            $agencies = $agenciesRepo->findAll();

            View::render('trip/create', [
                'title' => 'Ajouter un trajet - Touche Pas au Klaxon',
                'action' => '/trajets/ajouter',
                'agencies' => $agencies,
                'trip' => $tripFormData,
                'errors' => $errors,
                'user' => $user,
                'alert' => 'Le formulaire contient des erreurs.',
                'messageType' => 'danger',
            ]);
            return;
        }

        // Création du modèle + insertion
        $tripModel = new \App\Model\Trips(
            userId: $userId,
            departureAgencyId: (int)$departureAgencyId,
            arrivalAgencyId: (int)$arrivalAgencyId,
            departureTime: $departureDT, // non-null ici car empty($errors)
            arrivalTime: $arrivalDT,     // non-null ici car empty($errors)
            availableSeats: (int)$availableSeats
        );

        try {
            $newId = $tripRepo->create($tripModel);
            $tripModel->setId($newId);
        } catch (\PDOException $e) {
            // Ne pas exposer l'erreur SQL à l'utilisateur
            $agencies = $agenciesRepo->findAll();

            View::render('trip/create', [
                'title' => 'Ajouter un trajet - Touche Pas au Klaxon',
                'action' => '/trajets/ajouter',
                'agencies' => $agencies,
                'trip' => $tripFormData,
                'errors' => ['form' => "Impossible d'enregistrer le trajet. Merci de réessayer."],
                'user' => $user,
                'alert' => "Erreur lors de l'enregistrement.",
                'messageType' => 'danger',
            ]);
            return;
        }

        // Message de succès affiché sur /trajets (index lit alert/messageType)
        $_SESSION['alert'] = 'Trajet ajouté avec succès.';
        $_SESSION['messageType'] = 'success';

        header('Location: /trajets');
        exit;
    }

    public function edit(int $id): void
    {
        $this->requireAuth();

        $pdo = \App\Core\Connection::getPdo();
        $tripRepo = new \App\Repository\TripRepository($pdo);

        $tripObj = $tripRepo->findById($id);

        if ($tripObj === null) {
            http_response_code(404);
            exit('Trajet introuvable.');
        }

        // Sécurité : admin ou propriétaire
        $isAdmin = (($_SESSION['user']['role'] ?? '') === 'admin');
        $currentUserId = (int)($_SESSION['user']['id'] ?? 0);

        if (!$isAdmin && $tripObj->getUserId() !== $currentUserId) {
            http_response_code(403);
            exit('Accès refusé.');
        }

        $agenciesRepo = new \App\Repository\AgenciesRepository($pdo);
        $agencies = $agenciesRepo->findAll();

        $trip = [
            'id' => $tripObj->getId(),
            'departure_agency_id' => $tripObj->getDepartureAgencyId(),
            'arrival_agency_id' => $tripObj->getArrivalAgencyId(),
            'departure_date' => $tripObj->getDepartureTime()->format('Y-m-d'),
            'departure_time' => $tripObj->getDepartureTime()->format('H:i'),
            'arrival_date' => $tripObj->getArrivalTime()->format('Y-m-d'),
            'arrival_time' => $tripObj->getArrivalTime()->format('H:i'),
            'available_seats' => $tripObj->getAvailableSeats(),
        ];

        View::render('trip/edit', [
            'title' => 'Modifier un trajet - Touche Pas au Klaxon',
            'submitLabel' => 'Modifier le trajet',
            'action' => "/trajets/{$id}/edit",
            'agencies' => $agencies,
            'trip' => $trip,
            'errors' => [],
        ]);
    }

    public function update(int $id): void
    {
        $this->requireAuth();

        // (Optionnel mais utile) : s'assurer que l'id route et l'id POST matchent si tu postes aussi l'id
        $postId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($postId !== null && $postId !== false && $postId !== $id) {
            http_response_code(400);
            exit('Requête invalide.');
        }

        $pdo = \App\Core\Connection::getPdo();
        $tripRepo = new \App\Repository\TripRepository($pdo);

        $existingTrip = $tripRepo->findById($id);
        if ($existingTrip === null) {
            http_response_code(404);
            exit('Trajet introuvable.');
        }

        // Droits : admin ou propriétaire
        $isAdmin = (($_SESSION['user']['role'] ?? '') === 'admin');
        $currentUserId = (int)($_SESSION['user']['id'] ?? 0);

        if (!$isAdmin && $existingTrip->getUserId() !== $currentUserId) {
            http_response_code(403);
            exit('Accès refusé.');
        }

        // Lecture défensive (mêmes champs que store)
        $departureAgencyId = filter_input(INPUT_POST, 'departure_agency_id', FILTER_VALIDATE_INT);
        $arrivalAgencyId   = filter_input(INPUT_POST, 'arrival_agency_id', FILTER_VALIDATE_INT);

        $departureDate = (string)(filter_input(INPUT_POST, 'departure_date') ?? '');
        $departureTime = (string)(filter_input(INPUT_POST, 'departure_time') ?? '');
        $arrivalDate   = (string)(filter_input(INPUT_POST, 'arrival_date') ?? '');
        $arrivalTime   = (string)(filter_input(INPUT_POST, 'arrival_time') ?? '');

        $availableSeats = filter_input(INPUT_POST, 'available_seats', FILTER_VALIDATE_INT);

        $errors = [];

        // Requis
        if ($departureAgencyId === false || $departureAgencyId === null) {
            $errors['departure_agency_id'] = "L'agence de départ est obligatoire.";
        }
        if ($arrivalAgencyId === false || $arrivalAgencyId === null) {
            $errors['arrival_agency_id'] = "L'agence d'arrivée est obligatoire.";
        }

        if (trim($departureDate) === '') {
            $errors['departure_date'] = "La date de départ est obligatoire.";
        }
        if (trim($departureTime) === '') {
            $errors['departure_time'] = "L'heure de départ est obligatoire.";
        }
        if (trim($arrivalDate) === '') {
            $errors['arrival_date'] = "La date d'arrivée est obligatoire.";
        }
        if (trim($arrivalTime) === '') {
            $errors['arrival_time'] = "L'heure d'arrivée est obligatoire.";
        }

        if ($availableSeats === false || $availableSeats === null) {
            $errors['available_seats'] = "Le nombre de places disponibles est obligatoire.";
        }

        // Règle 1 : agences différentes
        if (
            !isset($errors['departure_agency_id'], $errors['arrival_agency_id'])
            && (int)$departureAgencyId === (int)$arrivalAgencyId
        ) {
            $errors['arrival_agency_id'] = "L'agence d'arrivée doit être différente de l'agence de départ.";
        }

        // Règle 3 : places > 0
        if (!isset($errors['available_seats']) && (int)$availableSeats <= 0) {
            $errors['available_seats'] = "Le nombre total de places doit être supérieur à 0.";
        }

        // Construire DateTimeImmutable
        $departureDT = null;
        $arrivalDT   = null;

        if (!isset($errors['departure_date'], $errors['departure_time'])) {
            $departureDT = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $departureDate . ' ' . $departureTime);
            if ($departureDT === false) {
                $errors['departure_date'] = "Date/heure de départ invalide.";
            }
        }

        if (!isset($errors['arrival_date'], $errors['arrival_time'])) {
            $arrivalDT = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $arrivalDate . ' ' . $arrivalTime);
            if ($arrivalDT === false) {
                $errors['arrival_date'] = "Date/heure d'arrivée invalide.";
            }
        }

        // Règle 2 : arrivée > départ
        if ($departureDT instanceof \DateTimeImmutable && $arrivalDT instanceof \DateTimeImmutable) {
            if ($arrivalDT <= $departureDT) {
                $errors['arrival_date'] = "La date/heure d'arrivée doit être supérieure à la date/heure de départ.";
            }
        }

        // Règle 4 : pas de doublon (en excluant ce trajet)
        if (
            empty($errors)
            && $departureDT instanceof \DateTimeImmutable
            && $arrivalDT instanceof \DateTimeImmutable
            && $tripRepo->existsDuplicateExcludingId(
                $id,
                (int)$departureAgencyId,
                (int)$arrivalAgencyId,
                $departureDT,
                $arrivalDT
            )
        ) {
            $errors['form'] = "Un trajet identique existe déjà.";
        }

        // En cas d'erreurs : ré-afficher le formulaire edit pré-rempli
        if (!empty($errors)) {
            $agenciesRepo = new \App\Repository\AgenciesRepository($pdo);
            $agencies = $agenciesRepo->findAll();

            $trip = [
                'id' => $id,
                'departure_agency_id' => $departureAgencyId,
                'arrival_agency_id'   => $arrivalAgencyId,
                'departure_date'      => $departureDate,
                'departure_time'      => $departureTime,
                'arrival_date'        => $arrivalDate,
                'arrival_time'        => $arrivalTime,
                'available_seats'     => $availableSeats,
            ];

            View::render('trip/edit', [
                'title'       => 'Modifier un trajet - Touche Pas au Klaxon',
                'submitLabel' => 'Modifier le trajet',
                'action'      => "/trajets/{$id}/edit",
                'agencies'    => $agencies,
                'trip'        => $trip,
                'errors'      => $errors,
                'alert'       => 'Le formulaire contient des erreurs.',
                'messageType' => 'danger',
            ]);
            return;
        }

        // Construire le modèle et mettre à jour
        $updatedTrip = new \App\Model\Trips(
            userId: $existingTrip->getUserId(), // on ne change pas l'auteur
            departureAgencyId: (int)$departureAgencyId,
            arrivalAgencyId: (int)$arrivalAgencyId,
            departureTime: $departureDT,
            arrivalTime: $arrivalDT,
            availableSeats: (int)$availableSeats
        );
        $updatedTrip->setId($id);

        try {
            $tripRepo->update($updatedTrip);
        } catch (\PDOException $e) {
            // Ne pas exposer le détail SQL
            $agenciesRepo = new \App\Repository\AgenciesRepository($pdo);
            $agencies = $agenciesRepo->findAll();

            View::render('trip/edit', [
                'title'       => 'Modifier un trajet - Touche Pas au Klaxon',
                'submitLabel' => 'Modifier le trajet',
                'action'      => "/trajets/{$id}/edit",
                'agencies'    => $agencies,
                'trip'        => [
                    'id' => $id,
                    'departure_agency_id' => $departureAgencyId,
                    'arrival_agency_id'   => $arrivalAgencyId,
                    'departure_date'      => $departureDate,
                    'departure_time'      => $departureTime,
                    'arrival_date'        => $arrivalDate,
                    'arrival_time'        => $arrivalTime,
                    'available_seats'     => $availableSeats,
                ],
                'errors'      => ['form' => "Impossible de modifier le trajet. Merci de réessayer."],
                'alert'       => "Erreur lors de la modification.",
                'messageType' => 'danger',
            ]);
            return;
        }

        $_SESSION['alert'] = 'Trajet modifié avec succès';
        $_SESSION['messageType'] = 'success';

        header('Location: /trajets');
        exit;
    }

    public function delete(): void
    {
        $this->requireAuth();

        $id = (int)($_POST['id'] ?? 0);

        $pdo = \App\Core\Connection::getPdo();
        $tripRepo = new \App\Repository\TripRepository($pdo);
        $tripRepo->delete($id);

        $_SESSION['alert'] = 'Trajet supprimé avec succès';
        $_SESSION['messageType'] = 'success';

        header('Location: /trajets');
        exit;
    }
    
}
