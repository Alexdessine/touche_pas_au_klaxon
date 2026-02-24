<?php

declare(strict_types=1);

namespace App\Core;

use App\Repository\AgenciesRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;
use Throwable;

final class View
{
    public static function render(string $template, array $data = []): void
    {
        try {
            // ne calculer que si admin
            if (Auth::check() && Auth::isAdmin()) {
                $pdo = Connection::getPdo();
                $data['userCount'] = (new UserRepository($pdo))->count();
                $data['agencyCount'] = (new AgenciesRepository($pdo))->count();
                $data['tripCount'] = (new TripRepository($pdo))->count();
            }
        } catch (Throwable $e) {
            $data['userCount'] = $data['userCount'] ?? 0;
            $data['agencyCount'] = $data['agencyCount'] ?? 0;
            $data['tripCount'] = $data['tripCount'] ?? 0;
            error_log((string) $e);
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require dirname(__DIR__, 2) . '/views/' . $template . '.php';
        $content = ob_get_clean();

        require dirname(__DIR__, 2) . '/views/layout/base.php';
    }
}
