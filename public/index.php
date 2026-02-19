<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
if (isset($_GET['debug']) && $_GET['debug'] === 'login') {
    $_SESSION['user'] = [
        'id' => 1,
        'firstname' => 'Alex',
        'lastname' => 'Martin',
        'role' => 'admin'
    ];
}

if (isset($_GET['debug']) && $_GET['debug'] === 'logout') {
    unset($_SESSION['user']);
}

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
    http_response_code(500);
    echo '500 - Erreur interne';
}
