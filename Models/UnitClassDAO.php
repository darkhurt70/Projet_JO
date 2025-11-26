<?php
namespace Models;

require_once 'BasePDODAO.php';
require_once 'UnitClass.php';

/**
 * DAO (Data Access Object) pour la table 'unitclass'.
 * Permet la lecture, création et récupération des classes d’unité.
 */
class UnitClassDAO extends BasePDODAO
{
    /**
     * Récupère une classe par son identifiant.
     * @param int $id
     * @return UnitClass|null
     */
    public function getById(int $id): ?UnitClass
    {
        $sql = "SELECT * FROM unitclass WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $row = $stmt->fetch();

        // Si aucune ligne n’est trouvée, retourne null
        if (!$row) return null;

        // Création de l’objet UnitClass à partir de la ligne SQL
        $unit = new UnitClass();
        $unit->setId($row['id']);
        $unit->setName($row['name']);
        $unit->setUrlImg($row['url_img']);

        return $unit;
    }

    /**
     * Récupère toutes les classes existantes en base.
     * @return UnitClass[]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass";
        $stmt = $this->execRequest($sql);
        $list = [];

        // Pour chaque ligne, on crée un objet UnitClass
        while ($row = $stmt->fetch()) {
            $unit = new UnitClass();
            $unit->setId($row['id']);
            $unit->setName($row['name']);
            $unit->setUrlImg($row['url_img']);
            $list[] = $unit;
        }

        return $list;
    }

    /**
     * Insère une nouvelle classe dans la base.
     * @param UnitClass $unitClass
     */
    public function create(UnitClass $unitClass): void
    {
        $sql = "INSERT INTO unitclass (name, url_img) VALUES (:name, :url_img)";

        $params = [
            "name"    => $unitClass->getName(),
            "url_img" => $unitClass->getUrlImg()
        ];

        $this->execRequest($sql, $params);
    }
}
