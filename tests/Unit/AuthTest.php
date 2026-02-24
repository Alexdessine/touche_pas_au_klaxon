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

    /**
     * Vérifie que la méthode check() retourne false lorsque aucune session utilisateur n'est définie, et true lorsque la session contient un tableau d'utilisateur.
     */
    public function testCheckReturnsFalseWhenNoUserInSession(): void
    {
        $this->assertFalse(Auth::check());
    }

    /**
     * Vérifie que la méthode check() retourne true lorsque la session contient une clé 'user' avec un tableau, et false dans les autres cas (clé absente ou non-tableau).
     */
    public function testCheckReturnsTrueWhenUserArrayInSession(): void
    {
        $_SESSION['user'] = ['id' => 1];
        $this->assertTrue(Auth::check());
    }

    /**
     * Vérifie que la méthode user() retourne null lorsque aucun utilisateur n'est connecté, et retourne les données de l'utilisateur stockées dans la session lorsque check() est vrai.
     */
    public function testUserReturnsNullWhenNotAuthenticated(): void
    {
        $this->assertNull(Auth::user());
    }

    /**
     * Vérifie que la méthode user() retourne les données de l'utilisateur stockées dans la session lorsque check() est vrai, et que ces données sont exactement celles définies dans $_SESSION['user'].
     */
    public function testUserReturnsArrayWhenAuthenticated(): void
    {
        $_SESSION['user'] = ['id' => 1, 'role' => 'user'];
        $this->assertSame(['id' => 1, 'role' => 'user'], Auth::user());
    }

    /**
     * Vérifie que la méthode logout() supprime la clé 'user' de la session et régénère l'ID de session si la session est active.
     */
    public function testLogoutUnsetsUserFromSession(): void
    {
        $_SESSION['user'] = ['id' => 1, 'role' => 'user'];

        Auth::logout();

        $this->assertArrayNotHasKey('user', $_SESSION);
        $this->assertFalse(Auth::check());
    }

    /**
     * Vérifie que la méthode attempt() retourne false lorsque l'utilisateur n'est pas trouvé, lorsque le hash du mot de passe est vide, ou lorsque le mot de passe fourni ne correspond pas au hash. Vérifie également que la session n'est pas modifiée dans ces cas.
     */
    public function testAttemptReturnsFalseWhenUserNotFound(): void
    {
        $repo = $this->makeUserRepositoryReturningRow(null, 'missing@example.com');

        $ok = Auth::attempt($repo, 'missing@example.com', 'secret');

        $this->assertFalse($ok);
        $this->assertArrayNotHasKey('user', $_SESSION);
    }

    /**
     * Vérifie que la méthode attempt() retourne false lorsque le hash du mot de passe est vide, même si l'utilisateur est trouvé. Vérifie également que la session n'est pas modifiée dans ce cas.
     */
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

    /**
     * Vérifie que la méthode attempt() retourne false lorsque le mot de passe fourni ne correspond pas au hash stocké, même si l'utilisateur est trouvé. Vérifie également que la session n'est pas modifiée dans ce cas.
     */
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

    /**
     * Vérifie que la méthode attempt() retourne true lorsque l'utilisateur est trouvé et que le mot de passe correspond au hash stocké, et que les données de l'utilisateur sont correctement stockées dans la session (sans le mot de passe).
     */
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

    /**
     * Vérifie que la méthode isAdmin() retourne true uniquement lorsque la session utilisateur contient un rôle 'admin', et false dans les autres cas (rôle différent ou utilisateur non connecté).
     */
    public function testIsAdminReturnsTrueOnlyForAdminRole(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];
        $this->assertTrue(Auth::isAdmin());

        $_SESSION['user'] = ['role' => 'user'];
        $this->assertFalse(Auth::isAdmin());

        unset($_SESSION['user']);
        $this->assertFalse(Auth::isAdmin());
    }

    /**
     * Vérifie que la méthode isUser() retourne true uniquement lorsque la session utilisateur contient un rôle 'user', et false dans les autres cas (rôle différent ou utilisateur non connecté).
     */
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