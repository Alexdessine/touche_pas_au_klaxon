<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Auth;

abstract class BaseController
{
    protected function requireAuth(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }
    }

    protected function requireAdmin(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if (!Auth::isAdmin()) {
            http_response_code(403);
            echo 'Accès interdit';
            exit;
        }
    }
}
