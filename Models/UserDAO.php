<?php
namespace Models;

use PDO;
use PDOException;

/**
 * Classe DAO pour l'entité User.
 * Permet de manipuler les utilisateurs dans la base de données.
 */
class UserDAO extends BasePDODAO
{
    /**
     * Récupère un utilisateur à partir de son nom d'utilisateur.
     *
     * @param string $username
     * @return User|null L'utilisateur correspondant ou null s'il n'existe pas.
     */
    public function getByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute([$username]);
        $data = $stmt->fetch();

        // ⚠️ Bug ici : le constructeur User attend (id, username, hashPwd)
        // Or tu fournis seulement (username, password)
        if ($data) {
            return new User(
                $data['id'],
                $data['username'],
                $data['hash_pwd'] // Assure-toi que le nom de la colonne est correct
            );
        }

        return null;
    }

    /**
     * Insère un nouvel utilisateur dans la base.
     *
     * @param User $user
     * @return bool True si insertion réussie, false sinon
     */
    public function insert(User $user): bool
    {
        try {
            // ⚠️ Bug ici : tu appelles $this->pdo mais il n'existe pas dans BasePDODAO
            // Tu dois utiliser $this->getDB()
            $stmt = $this->getDB()->prepare("
                INSERT INTO user (id, username, hash_pwd)
                VALUES (:id, :username, :hash_pwd)
            ");

            return $stmt->execute([
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'hash_pwd' => $user->getHashPwd()
            ]);
        } catch (PDOException $e) {
            // Idéalement logue l'erreur ici
            return false;
        }
    }
}
