<?php

namespace Models;

require_once 'BasePDODAO.php';
require_once 'UnitClass.php';

class UnitClassDAO extends BasePDODAO
{
    public function getById(int $id): ?UnitClass
    {
        $sql = "SELECT * FROM unitclass WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $unit = new UnitClass();
        $unit->setId($row['id']);
        $unit->setName($row['name']);
        $unit->setUrlImg($row['url_img']);
        return $unit;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass";
        $stmt = $this->execRequest($sql);
        $list = [];

        while ($row = $stmt->fetch()) {
            $unit = new UnitClass();
            $unit->setId($row['id']);
            $unit->setName($row['name']);
            $unit->setUrlImg($row['url_img']);
            $list[] = $unit;
        }

        return $list;
    }
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