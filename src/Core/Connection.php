<?php

declare(strict_types=1);

namespace App\Core;

use PDO;


/**
 * Classe de connexion à la base de données.
 * Fournit une instance unique de PDO pour toute l'application.
 */
final class Connection
{
    private static ?PDO $pdo = null;

    /**
     * Retourne une instance unique de PDO pour la connexion à la base de données.
     *
     * @return PDO L'instance de PDO
     * @throws \RuntimeException Si les variables d'environnement nécessaires sont manquantes
     */
    public static function getPdo(): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $port = $_ENV['DB_PORT'] ?? '3306';
        $db   = $_ENV['MYSQL_DATABASE'] ?? null;
        $user = $_ENV['MYSQL_USER'] ?? null;
        $pass = $_ENV['MYSQL_PASSWORD'] ?? '';

        if (!$db || !$user) {
            throw new \RuntimeException('Variables DB manquantes (MYSQL_DATABASE, MYSQL_USER).');
        }

        $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

        self::$pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        return self::$pdo;
    }
}
