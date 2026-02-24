<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// ini_set('log_errors', '1');
// ini_set('error_log', 'php://stderr');
// error_reporting(E_ALL);

// set_exception_handler(function (Throwable $e) {
//     error_log("Uncaught exception: " . $e);
//     http_response_code(500);
//     echo "Internal Server Error";
// });

// register_shutdown_function(function () {
//     $err = error_get_last();
//     if ($err !== null) {
//         error_log("Fatal error: " . print_r($err, true));
//     }
// });


use Dotenv\Dotenv;
use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

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
    error_log((string) $e); // << indispensable pour voir la vraie cause dans docker logs
    http_response_code(500);
}
