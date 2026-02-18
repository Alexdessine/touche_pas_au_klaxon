<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $template, array $data = []): void
    {
        extract($data);
        
        $viewPath = dirname(__DIR__, 2) . '/views/' . $template . '.php';

        if (!file_exists($viewPath)) {
            throw new \RuntimeException("Vue introuvable : $view");
        }

        require dirname(__DIR__, 2) . '/views/layout/header.php';
        require $viewPath;
        require dirname(__DIR__, 2) . '/views/layout/footer.php';
    }
}