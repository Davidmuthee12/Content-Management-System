<?php

namespace App\Admin\Support;

use PDO;

class AuthService {

    public function __construct(private PDO $pdo) {}

    public function handleLogin(string $username, string $password): bool {
        if (empty($username)) return false;
        if (empty($password)) return false;

        $stmt = $this->pdo->prepare('SELECT  `id`, `password` FROM `users` WHERE `username` = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);

        $hash = $entry['password'];
        $passwordOK = password_verify($password, $hash);
        if (empty($passwordOK)) {
            return false;
        }

        session_start();
        $_SESSION['adminUserId'] = $entry['id'];

        return true;
    }

    public function isLoggedIn(): bool {
        session_start();
        return !empty($_SESSION['adminUserId']);
    }

    public function ensureLoggedIn() {
        $isLoggedIn = $this->isLoggedIn();
        if (empty($isLoggedIn)) {
            header('Location: index.php?' . http_build_query(['route' => 'admin/login']));
            die();
        }
    }
}