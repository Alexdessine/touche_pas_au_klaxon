<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    /** @var array<int, array{method:string, path:string, controller: array{0: class-string, 1: string}}> */
    private array $routes;

    /**
     * @param array<int, array{method:string, path:string, controller: array{0: class-string, 1: string}}> $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(string $method, string $uri): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                [$class, $action] = $route['controller'];

                $controller = new $class();

                // Appel sécurisé
                if (!method_exists($controller, $action)) {
                    http_response_code(500);
                    echo '500 - Action introuvable';
                    return;
                }

                $controller->$action();
                return;
            }
        }

        http_response_code(404);
        echo '404 - Route non trouvée';
    }
}
