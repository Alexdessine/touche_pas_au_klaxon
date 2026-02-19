<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;

final class AuthController
{
    public function showLoginForm(): void
    {
        if (Auth::check()) {
            header('Location: /admin');
            exit;
        }

        View::render('auth/login', [
            'title' => 'Connexion - Touche Pas au Klaxon',
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
