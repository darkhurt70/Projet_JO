<?php

namespace Models;

use Config\Config;
use PDO;
use PDOException;

// Classe abstraite à hériter pour tout DAO accédant à la base via PDO
abstract class BasePDODAO {
    // Propriété privée pour stocker l'objet PDO (connexion à la BDD)
    private ?PDO $db = null;

    /**
     * Récupère la connexion à la base de données (singleton local)
     * Si la connexion n’existe pas encore, elle est créée via PDO.
     *
     * @return PDO Instance PDO connectée
     */
    protected function getDB(): PDO {
        // Connexion à la base seulement si elle n'existe pas encore
        if ($this->db === null) {
            try {
                // Création d'une nouvelle instance PDO à partir de la configuration
                $this->db = new PDO(
                    Config::get('dsn'),   // DSN = driver + host + dbname
                    Config::get('user'),  // Nom d'utilisateur
                    Config::get('pass')   // Mot de passe
                );

                // Définir le mode d’erreur sur exception
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Si la connexion échoue, arrêt avec message d'erreur
                die("Erreur de connexion à la BDD : " . $e->getMessage());
            }
        }

        return $this->db;
    }

    /**
     * Exécute une requête SQL préparée (SELECT, INSERT, UPDATE, DELETE...)
     *
     * @param string $sql     La requête SQL avec des marqueurs (:param)
     * @param ?array $params  Tableau associatif des paramètres (optionnel)
     * @return PDOStatement   Résultat de la requête
     */
    protected function execRequest(string $sql, ?array $params = null) {
        // Prépare la requête pour éviter les injections SQL
        $stmt = $this->getDB()->prepare($sql);

        // Exécute la requête avec ou sans paramètres
        $stmt->execute($params ?? []);

        return $stmt;
    }
}
