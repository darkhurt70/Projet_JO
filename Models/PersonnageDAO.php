<?php

namespace Models;

require_once 'BasePDODAO.php';
require_once 'Personnage.php';

use Services\PersonnageService; // Pour hydratation d’un personnage complet (avec objets associés)

/**
 * DAO pour la table "personnage"
 */
class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les personnages depuis la base
     * @return Personnage[]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM personnage";
        $stmt = $this->execRequest($sql);
        $personnages = [];

        // DAOs nécessaires pour reconstruire les objets liés
        $elementDAO = new ElementDAO();
        $originDAO = new OriginDAO();
        $unitDAO = new UnitClassDAO();

        while ($row = $stmt->fetch()) {
            // Récupération des objets liés
            $element = $elementDAO->getById($row['element']);
            $origin = $originDAO->getById($row['origin']);
            $unit   = $unitDAO->getById($row['unitclass']);

            // Création du personnage via un service d'hydratation
            $p = PersonnageService::hydrate($row, $element, $origin, $unit);
            $personnages[] = $p;
        }

        return $personnages;
    }

    /**
     * Récupère un personnage via son identifiant
     */
    public function getByID(string $id): ?Personnage
    {
        $sql = "SELECT * FROM personnage WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);

        $row = $stmt->fetch();

        if (!$row) return null;

        // Récupération des objets liés
        $element = (new ElementDAO())->getById($row['element']);
        $origin  = (new OriginDAO())->getById($row['origin']);
        $unit    = (new UnitClassDAO())->getById($row['unitclass']);

        return PersonnageService::hydrate($row, $element, $origin, $unit);
    }

    /**
     * Supprime un personnage en base à partir de son ID
     * @return bool Retourne vrai si un personnage a été supprimé
     */
    public function deletePerso(string $idPerso): bool
    {
        $sql = "DELETE FROM personnage WHERE id = :id";
        $stmt = $this->execRequest($sql, ["id" => $idPerso]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Met à jour un personnage existant
     */
    public function updatePersonnage(Personnage $personnage): void
    {
        $sql = "UPDATE personnage SET 
                    name = :name, 
                    element = :element, 
                    origin = :origin, 
                    unitclass = :unitclass, 
                    rarity = :rarity, 
                    url_img = :url_img
                WHERE id = :id";

        $params = [
            "id"        => $personnage->getId(),
            "name"      => $personnage->getName(),
            "element"   => $personnage->getElement()->getId(),
            "origin"    => $personnage->getOrigin()->getId(),
            "unitclass" => $personnage->getUnitclass()->getId(),
            "rarity"    => $personnage->getRarity(),
            "url_img"   => $personnage->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
    }

    /**
     * Insère un nouveau personnage dans la base
     */
    public function createPersonnage(Personnage $personnage): void
    {
        $sql = "INSERT INTO personnage (id, name, element, origin, unitclass, rarity, url_img)
                VALUES (:id, :name, :element, :origin, :unitclass, :rarity, :url_img)";

        $params = [
            "id"        => $personnage->getId(),
            "name"      => $personnage->getName(),
            "element"   => $personnage->getElement()->getId(),
            "origin"    => $personnage->getOrigin()->getId(),
            "unitclass" => $personnage->getUnitclass()->getId(),
            "rarity"    => $personnage->getRarity(),
            "url_img"   => $personnage->getUrlImg()
        ];

        $this->execRequest($sql, $params);
    }
}
