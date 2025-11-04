<?php

namespace Models;

use Config\Config;
use PDO;
use PDOException;

abstract class BasePDODAO {
    private ?PDO $db = null;

    protected function getDB(): PDO {
        if ($this->db === null) {
            try {
                $this->db = new PDO(
                    Config::get('dsn'),
                    Config::get('user'),
                    Config::get('pass')
                );
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la BDD : " . $e->getMessage());
            }
        }

        return $this->db;
    }

    protected function execRequest(string $sql, array $params = null) {
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params ?? []);
        return $stmt;
    }
}
