<?php

namespace Models;

// Inclusion des dépendances nécessaires (normalement géré par autoload en PSR-4)
require_once 'BasePDODAO.php';
require_once 'Origin.php';

class OriginDAO extends BasePDODAO
{
    /**
     * Récupère une origine par son identifiant
     * @param int $id ID de l'origine recherchée
     * @return Origin|null L'objet Origin correspondant ou null si non trouvé
     */
    public function getById(int $id): ?Origin
    {
        $sql = "SELECT * FROM origin WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $origin = new Origin();
        $origin->setId($row['id']);
        $origin->setName($row['name']);
        $origin->setUrlImg($row['url_img']);
        return $origin;
    }

    /**
     * Récupère toutes les origines enregistrées
     * @return Origin[] Liste d'objets Origin
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM origin";
        $stmt = $this->execRequest($sql);
        $list = [];

        // Conversion de chaque ligne SQL en objet Origin
        while ($row = $stmt->fetch()) {
            $origin = new Origin();
            $origin->setId($row['id']);
            $origin->setName($row['name']);
            $origin->setUrlImg($row['url_img']);
            $list[] = $origin;
        }

        return $list;
    }

    /**
     * Crée une nouvelle entrée dans la table `origin`
     * @param Origin $origin Objet contenant le nom et l'image
     */
    public function create(Origin $origin): void
    {
        $sql = "INSERT INTO origin (name, url_img) VALUES (:name, :url_img)";

        $params = [
            "name"    => $origin->getName(),
            "url_img" => $origin->getUrlImg()
        ];

        $this->execRequest($sql, $params);
    }
}
