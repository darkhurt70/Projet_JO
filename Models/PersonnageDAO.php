<?php


namespace Models;

require_once 'BasePDODAO.php';
require_once 'Personnage.php';

class PersonnageDAO extends BasePDODAO
{

    public function getAll(): array
    {
        $sql = "SELECT * FROM personnage";
        $stmt = $this->execRequest($sql);
        $personnages = [];

        while ($row = $stmt->fetch()) {
            $p = new Personnage();
            $p->setId($row['id']);
            $p->setName($row['name']);
            $p->setElement($row['element']);
            $p->setUnitclass($row['unitclass']);
            $p->setRarity((int)$row['rarity']);
            $p->setOrigin($row['origin']);
            $p->setUrlImg($row['url_img']);
            $personnages[] = $p;
        }

        return $personnages;
    }

    public function getByID(string $id): ?Personnage
    {
        $sql = "SELECT * FROM personnage WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);

        $row = $stmt->fetch();
        if (!$row) return null;

        $p = new Personnage();
        $p->setId($row['id']);
        $p->setName($row['name']);
        $p->setElement($row['element']);
        $p->setUnitclass($row['unitclass']);
        $p->setRarity((int)$row['rarity']);
        $p->setOrigin($row['origin']);
        $p->setUrlImg($row['url_img']);

        return $p;
    }
}
