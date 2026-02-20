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
            header('Location: /');
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

    public function login(): void
    {
        // Ici, vous ajouteriez la logique pour vérifier les informations d'identification de l'utilisateur
        // Par exemple : Auth::attempt($_POST['email'], $_POST['password']);

        // Si la connexion est réussie, redirigez vers la page d'accueil
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        // Simulation utilisateur pour test
        $_SESSION['user'] = [
            'id' => 1,
            'firstname' => 'Alex',
            'lastname' => 'Martin',
            'role' => 'admin' // change en 'user' pour tester
        ];

        header('Location: /');
        exit;
    }
}
