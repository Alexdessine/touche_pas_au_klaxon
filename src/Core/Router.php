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
    // IMPORTANT : enlever la query string (?x=1)
    $path = parse_url($uri, PHP_URL_PATH) ?? '/';

    foreach ($this->routes as $route) {
        if (($route['method'] ?? '') !== $method) {
            continue;
        }

        // Remplace {id} par un groupe de capture numérique
        $pattern = preg_replace('#\{id\}#', '([0-9]+)', (string)($route['path'] ?? ''));
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $path, $matches)) {
            array_shift($matches);

            // Cast en int pour être compatible avec edit(int $id) en strict_types
            $matches = array_map('intval', $matches);

            [$controllerClass, $action] = $route['controller'];
            $controller = new $controllerClass();

            // Appel sans retourner une valeur (dispatch est void)
            $controller->$action(...$matches);
            return;
        }
    }

    http_response_code(404);
    echo '404 - Route non trouvée';
}

}
