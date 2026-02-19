<?php

declare(strict_types=1);

use App\Controller\HomeController;

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
        'controller' => [App\Controller\AdminDashboardController::class, 'index']
    ],

    [
        'method' => 'GET',
        'path' => '/login',
        'controller' => [App\Controller\AuthController::class, 'showLoginForm']
    ],

    [
        'method' => 'POST',
        'path' => '/login',
        'controller' => [App\Controller\AuthController::class, 'login']
    ],

    [
        'method' => 'GET',
        'path' => '/logout',
        'controller' => [App\Controller\AuthController::class, 'logout']
    ]
];