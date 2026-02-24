<?php

declare(strict_types=1);

use App\Repository\UserRepository;
use PDO;
use PDOStatement;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UserRepository::class)]
final class UserRepositoryTest extends TestCase
{
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
}