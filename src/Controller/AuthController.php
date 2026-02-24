<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;
use App\Repository\UserRepository;
use App\Core\Connection;


/** 
 * Contrôleur pour la gestion de l'authentification.
 */
final class AuthController
{

    /**     
     * Affiche le formulaire de connexion.
     *
     * @return void
     */
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

    /**     
     * Traite la soumission du formulaire de connexion.
     *
     * @return void
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        // Validation défensive
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password'); // pas de filtre spécial ici
        $remember = filter_input(INPUT_POST, 'remember', FILTER_VALIDATE_INT);

        $errors = [];

        if ($email === false || $email === null) {
            $errors['email'] = "Email invalide.";
        }

        if (!is_string($password) || trim($password) === '') {
            $errors['password'] = "Mot de passe requis.";
        }

        if (!empty($errors)) {
            // Ré-affichage du formulaire avec erreurs (sans fuite)
            View::render('auth/login', [
                'title' => 'Connexion - Touche Pas au Klaxon',
                'errors' => $errors,
                'old' => [
                    'email' => is_string($email) ? $email : '',
                    'remember' => (int) ($remember ?? 0),
                ],
            ]);
            return;
        }

        $pdo = Connection::getPdo();
        $userRepo = new UserRepository($pdo);

        $ok = Auth::attempt($userRepo, (string) $email, (string) $password);

        if (!$ok) {
            View::render('auth/login', [
                'title' => 'Connexion - Touche Pas au Klaxon',
                'errors' => [
                    'global' => "Identifiants invalides.",
                ],
                'old' => [
                    'email' => (string) $email,
                    'remember' => (int) ($remember ?? 0),
                ],
            ]);
            return;
        }

        $_SESSION['alert'] = "Connexion réussie.";
        $_SESSION['messageType'] = "success";

        header('Location: /');
        exit;
    }

    /**     
    * Traite la déconnexion de l'utilisateur.
    *
    * @return void
    */
    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}