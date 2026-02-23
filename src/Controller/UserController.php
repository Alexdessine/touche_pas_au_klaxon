<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\BaseController;
use App\Core\View;

final class UserController extends BaseController
{
    public function index(): void
    {
        // $this->requireAuth();
        // $this->requireAdmin();

        $pdo = \App\Core\Connection::getPdo();
        $userRepo = new \App\Repository\UserRepository($pdo);

        $users = $userRepo->findAll();

        View::render('users/index', [
            'title' => 'Utilisateurs - Touche Pas au Klaxon',
            'users' => $users,
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }

    
}
