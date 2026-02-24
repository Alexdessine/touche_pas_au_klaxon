<?php

declare(strict_types=1);

use App\Core\Auth;
use App\Repository\UserRepository;
use PDO;
use PDOStatement;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Auth::class)]
final class AuthTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [];
    }

    /**
     * Crée un UserRepository "réel" avec un PDO mocké qui renvoie $row via fetch().
     * Si $row === null, fetch() renverra false (utilisateur introuvable).
     *
     * @param array<string,mixed>|null $row
     */
    private function makeUserRepositoryReturningRow(?array $row, string $expectedEmail): UserRepository
    {
        $stmt = $this->createMock(PDOStatement::class);

        $stmt->expects($this->once())
            ->method('execute')
            ->with(['email' => $expectedEmail])
            ->willReturn(true);

        $stmt->expects($this->once())
            ->method('fetch')
            ->willReturn($row ?? false);

        $pdo = $this->createMock(PDO::class);
        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($stmt);

        return new UserRepository($pdo);
    }

    public function testCheckReturnsFalseWhenNoUserInSession(): void
    {
        $this->assertFalse(Auth::check());
    }

    public function testCheckReturnsTrueWhenUserArrayInSession(): void
    {
        $_SESSION['user'] = ['id' => 1];
        $this->assertTrue(Auth::check());
    }

    public function testUserReturnsNullWhenNotAuthenticated(): void
    {
        $this->assertNull(Auth::user());
    }

    public function testUserReturnsArrayWhenAuthenticated(): void
    {
        $_SESSION['user'] = ['id' => 1, 'role' => 'user'];
        $this->assertSame(['id' => 1, 'role' => 'user'], Auth::user());
    }

    public function testLogoutUnsetsUserFromSession(): void
    {
        $_SESSION['user'] = ['id' => 1, 'role' => 'user'];

        Auth::logout();

        $this->assertArrayNotHasKey('user', $_SESSION);
        $this->assertFalse(Auth::check());
    }

    public function testAttemptReturnsFalseWhenUserNotFound(): void
    {
        $repo = $this->makeUserRepositoryReturningRow(null, 'missing@example.com');

        $ok = Auth::attempt($repo, 'missing@example.com', 'secret');

        $this->assertFalse($ok);
        $this->assertArrayNotHasKey('user', $_SESSION);
    }

    public function testAttemptReturnsFalseWhenHashIsEmpty(): void
    {
        $row = [
            'id' => 10,
            'firstname' => 'A',
            'lastname' => 'B',
            'email' => 'user@example.com',
            'password' => '', // hash vide
            'phone' => '0600000000',
            'role' => 'user',
            'created_at' => '2026-02-01 12:00:00',
        ];

        $repo = $this->makeUserRepositoryReturningRow($row, 'user@example.com');

        $ok = Auth::attempt($repo, 'user@example.com', 'secret');

        $this->assertFalse($ok);
        $this->assertArrayNotHasKey('user', $_SESSION);
    }

    public function testAttemptReturnsFalseWhenPasswordIsInvalid(): void
    {
        $row = [
            'id' => 10,
            'firstname' => 'A',
            'lastname' => 'B',
            'email' => 'user@example.com',
            'password' => password_hash('correct', PASSWORD_DEFAULT),
            'phone' => '0600000000',
            'role' => 'user',
            'created_at' => '2026-02-01 12:00:00',
        ];

        $repo = $this->makeUserRepositoryReturningRow($row, 'user@example.com');

        $ok = Auth::attempt($repo, 'user@example.com', 'wrong');

        $this->assertFalse($ok);
        $this->assertArrayNotHasKey('user', $_SESSION);
    }

    public function testAttemptStoresUserDataInSessionOnSuccess(): void
    {
        $row = [
            'id' => 10,
            'firstname' => 'Alex',
            'lastname' => 'Martin',
            'email' => 'alex@example.com',
            'password' => password_hash('secret', PASSWORD_DEFAULT),
            'phone' => '0600000000',
            'role' => 'user',
            'created_at' => '2026-02-01 12:00:00',
        ];

        $repo = $this->makeUserRepositoryReturningRow($row, 'alex@example.com');

        $ok = Auth::attempt($repo, 'alex@example.com', 'secret');

        $this->assertTrue($ok);
        $this->assertSame(
            [
                'id' => 10,
                'firstname' => 'Alex',
                'lastname' => 'Martin',
                'email' => 'alex@example.com',
                'phone' => '0600000000',
                'role' => 'user',
            ],
            $_SESSION['user']
        );
    }

    public function testIsAdminReturnsTrueOnlyForAdminRole(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];
        $this->assertTrue(Auth::isAdmin());

        $_SESSION['user'] = ['role' => 'user'];
        $this->assertFalse(Auth::isAdmin());

        unset($_SESSION['user']);
        $this->assertFalse(Auth::isAdmin());
    }

    public function testIsUserReturnsTrueOnlyForUserRole(): void
    {
        $_SESSION['user'] = ['role' => 'user'];
        $this->assertTrue(Auth::isUser());

        $_SESSION['user'] = ['role' => 'admin'];
        $this->assertFalse(Auth::isUser());

        unset($_SESSION['user']);
        $this->assertFalse(Auth::isUser());
    }
}