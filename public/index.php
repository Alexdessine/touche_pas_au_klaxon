<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

use Dotenv\Dotenv;
use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

// Charger .env si présent
$envPath = dirname(__DIR__);
if (is_file($envPath . '/.env')) {
    Dotenv::createImmutable($envPath)->load();
}

$routes = require $envPath . '/config/routes.php';

try {
    $router = new Router($routes);

    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

    $router->dispatch($method, $uri);

} catch (Throwable $e) {
    error_log((string) $e);
    http_response_code(500);
}
