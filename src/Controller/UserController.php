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
        $this->requireAuth();
        $this->requireAdmin();

        View::render('users/index', [
            'title' => 'Utilisateurs - Touche Pas au Klaxon',
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
