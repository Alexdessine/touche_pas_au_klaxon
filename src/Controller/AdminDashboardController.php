<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;

final class AdminDashboardController
{
    public function index(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        View::render('admin/dashboard', [
            'title' => 'Administration - Touche Pas au Klaxon',
            'user' => Auth::user()
        ]);
    }
}
