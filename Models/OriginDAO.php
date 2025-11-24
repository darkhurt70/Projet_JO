<?php

namespace Models;

require_once 'BasePDODAO.php';
require_once 'Origin.php';

class OriginDAO extends BasePDODAO
{
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

    public function getAll(): array
    {
        $sql = "SELECT * FROM origin";
        $stmt = $this->execRequest($sql);
        $list = [];

        while ($row = $stmt->fetch()) {
            $origin = new Origin();
            $origin->setId($row['id']);
            $origin->setName($row['name']);
            $origin->setUrlImg($row['url_img']);
            $list[] = $origin;
        }

        return $list;
    }

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