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
        'path' => '/trajets',
        'controller' => [TripController::class, 'index']
    ]
];