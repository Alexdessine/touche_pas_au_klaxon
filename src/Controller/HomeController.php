<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;

final class HomeController
{
    public function index(): void
    {
        View::render('home/index', [
            'title' => 'Accueil - Touche Pas au Klaxon'
        ]);
    }
}
