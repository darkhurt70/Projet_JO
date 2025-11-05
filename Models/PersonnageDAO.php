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
}
