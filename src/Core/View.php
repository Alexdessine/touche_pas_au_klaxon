<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);

        ob_start();
        require dirname(__DIR__, 2) . '/views/' . $view . '.php';
        $content = ob_get_clean();

        require dirname(__DIR__, 2) . '/views/layout/base.php';
    }
}