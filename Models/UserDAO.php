<?php

namespace Models;

use PDO;
use PDOException;

class UserDAO extends BasePDODAO
{
    public function getByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->getDB()->prepare($sql); // ✅ Utiliser getDB()
        $stmt->execute([$username]);
        $data = $stmt->fetch();

        return $data ? new User($data['username'], $data['password']) : null;
    }

    public function insert(User $user): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO USERS (id, username, hash_pwd) VALUES (:id, :username, :hash_pwd)");
            return $stmt->execute([
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'hash_pwd' => $user->getHashPwd()
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
