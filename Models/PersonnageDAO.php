<?php


namespace Models;

require_once 'BasePDODAO.php';
require_once 'Personnage.php';
use Services\PersonnageService;



class PersonnageDAO extends BasePDODAO
{


    public function getAll(): array
    {
        $sql = "SELECT * FROM personnage";
        $stmt = $this->execRequest($sql);
        $personnages = [];

        while ($row = $stmt->fetch()) {
            $p = PersonnageService::hydrate($row);
            $personnages[] = $p;
        }

        return $personnages;
    }

    public function getByID(string $id): ?Personnage
    {
        $sql = "SELECT * FROM personnage WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);

        $row = $stmt->fetch();
        return $row ? PersonnageService::hydrate($row) : null;
    }

    public function createPersonnage(Personnage $personnage): void
    {
        $sql = "INSERT INTO personnage (id, name, element, origin, unitclass, rarity, url_img)
            VALUES (:id, :name, :element, :origin, :unitclass, :rarity, :url_img)";

        $params = [
            "id"        => $personnage->getId(),
            "name"      => $personnage->getName(),
            "element"   => $personnage->getElement(),
            "origin"    => $personnage->getOrigin(),
            "unitclass" => $personnage->getUnitclass(),
            "rarity"    => $personnage->getRarity(),
            "url_img"   => $personnage->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
    }

    public function deletePerso(string $idPerso): bool
    {
        $sql = "DELETE FROM personnage WHERE id = :id";
        $stmt = $this->execRequest($sql, ["id" => $idPerso]);
        return $stmt->rowCount() > 0;
    }

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
            "element"   => $personnage->getElement(),
            "origin"    => $personnage->getOrigin(),
            "unitclass" => $personnage->getUnitclass(),
            "rarity"    => $personnage->getRarity(),
            "url_img"   => $personnage->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
    }





}
