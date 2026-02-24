<?php

declare(strict_types=1);

namespace App\Core;


/**
 * Classe de routage pour gérer les requêtes HTTP et les acheminer vers les contrôleurs appropriés.
 */
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

    /**
    * Traite une requête HTTP en fonction de la méthode et de l'URI, et appelle le contrôleur correspondant.
    *
    * @param string $method La méthode HTTP (GET, POST, etc.)
    * @param string $uri L'URI de la requête
    * @return void
    */
    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $pattern = preg_replace('#\{id\}#', '([0-9]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);

                $matches = array_map('intval', $matches);

                [$controllerClass, $action] = $route['controller'];
                $controller = new $controllerClass();

                $controller->$action(...$matches);
                return;
            }
        }

        http_response_code(404);
        echo '404 - Route non trouvée';
    }
}
