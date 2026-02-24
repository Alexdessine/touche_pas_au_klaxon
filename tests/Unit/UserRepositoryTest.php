<?php

declare(strict_types=1);

use App\Repository\UserRepository;
use PDO;
use PDOStatement;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UserRepository::class)]
/**
 * Tests unitaires pour la classe UserRepository, couvrant la méthode findByEmail() dans les cas où l'utilisateur est trouvé ou non trouvé.
 */
final class UserRepositoryTest extends TestCase
{
    /**
     * Vérifie que la méthode findByEmail() retourne null lorsque l'utilisateur n'est pas trouvé, en simulant un résultat de requête falsy.
     */
    public function testFindByEmailReturnsNullWhenNotFound(): void
    {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with(['email' => 'missing@example.com'])
            ->willReturn(true);

        $stmt->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $pdo = $this->createMock(PDO::class);
        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($stmt);

        $repo = new UserRepository($pdo);

        $this->assertNull($repo->findByEmail('missing@example.com'));
    }

    /**
     * Vérifie que la méthode findByEmail() retourne un objet User correctement hydraté lorsque l'utilisateur est trouvé, en simulant un résultat de requête contenant les données de l'utilisateur.
     */
    public function testFindByEmailHydratesUserWhenFound(): void
    {
        $row = [
            'id'         => 10,
            'firstname'  => 'Alex',
            'lastname'   => 'Martin',
            'email'      => 'alex@example.com',
            'password'   => '$2y$10$hashhashhash', // hash factice, mais string OK
            'phone'      => '0600000000',
            'role'       => 'user',
            'created_at' => '2026-02-01 12:00:00',
        ];

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with(['email' => 'alex@example.com'])
            ->willReturn(true);

        $stmt->expects($this->once())
            ->method('fetch')
            ->willReturn($row);

        $pdo = $this->createMock(PDO::class);
        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($stmt);

        $repo = new UserRepository($pdo);

        $user = $repo->findByEmail('alex@example.com');

        $this->assertNotNull($user);

        $this->assertSame('App\Model\User', $user::class);
    }
}