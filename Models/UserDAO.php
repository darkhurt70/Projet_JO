<?php

namespace Models;

use PDO;
use PDOException;

class UserDAO extends DAO
{
    public function getByUsername(string $username): ?User
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM USERS WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new User($row['id'], $row['username'], $row['hash_pwd']);
            }

            return null;
        } catch (PDOException $e) {
            // Log possible
            return null;
        }
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
