<?php

declare(strict_types=1);

use App\Controller\AdminDashboardController;
use App\Controller\AgenciesController;
use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\TripController;
use App\Controller\UserController;

return [
    // Exemple de route
    // [
    //     'method' => 'GET',
    //     'path' => '/',
    //     'controller' => [App\Controller\HomeController::class, 'index']
    // ],
    [
        'method' => 'GET',
        'path' => '/',
        'controller' => [HomeController::class, 'index']
    ],

    [
        'method' => 'GET',
        'path' => '/admin',
        'controller' => [AdminDashboardController::class, 'index']
    ],

    [
        'method' => 'GET',
        'path' => '/login',
        'controller' => [AuthController::class, 'showLoginForm']
    ],

    [
        'method' => 'POST',
        'path' => '/login',
        'controller' => [AuthController::class, 'login']
    ],

    [
        'method' => 'GET',
        'path' => '/logout',
        'controller' => [AuthController::class, 'logout']
    ],

    [
        'method' => 'GET',
        'path' => '/utilisateurs',
        'controller' => [UserController::class, 'index']
    ],

    [
        'method' => 'GET',
        'path' => '/agences',
        'controller' => [AgenciesController::class, 'index']
    ],

    [
        'method' => 'GET',
        'path' => '/agences/ajouter',
        'controller' => [AgenciesController::class, 'create']
    ],

    [
        'method' => 'GET',
        'path' => '/agences/{id}/edit',
        'controller' => [AgenciesController::class, 'edit']
    ],

    [
        'method' => 'POST',
        'path' => '/agences/ajouter',
        'controller' => [AgenciesController::class, 'store']
    ],

    [
        'method' => 'POST',
        'path' => '/agences/{id}/edit',
        'controller' => [AgenciesController::class, 'update']
    ],

    [
        'method' => 'POST',
        'path' => '/agences/{id}/delete',
        'controller' => [AgenciesController::class, 'delete']
    ],

    [
        'method' => 'GET',
        'path' => '/trajets',
        'controller' => [TripController::class, 'index']
    ],

    [
        'method' => 'GET',
        'path' => '/trajets/ajouter',
        'controller' => [TripController::class, 'create']
    ],

    [
        'method' => 'GET',
        'path' => '/trajets/{id}/edit',
        'controller' => [TripController::class, 'edit']
    ],

    [
        'method' => 'POST',
        'path' => '/trajets/ajouter',
        'controller' => [TripController::class, 'store']
    ],

    [
        'method' => 'POST',
        'path' => '/trajets/{id}/edit',
        'controller' => [TripController::class, 'update']
    ],

    [
        'method' => 'POST',
        'path' => '/trajets/{id}/delete',
        'controller' => [TripController::class, 'delete']
    ]

];