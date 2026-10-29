<?php

namespace App\Admin\Support;

use PDO;

class AuthService {

    public function __construct(private PDO $pdo) {}

    public function handleLogin(string $username, string $password): bool {
        if (empty($username)) return false;
        if (empty($password)) return false;

        $stmt = $this->pdo->prepare('SELECT `password` FROM `users` WHERE `username` = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);

        $hash = $entry['password'];
        $passwordOK = password_verify($password, $hash);
        if (empty($passwordOK)) {
            return false;
        }
        return true;
    }
}