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
];