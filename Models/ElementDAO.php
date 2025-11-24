<?php

namespace Models;

use Models\Element;

require_once 'BasePDODAO.php';
require_once 'Element.php';

class ElementDAO extends BasePDODAO
{
    public function getById(int $id): ?Element
    {
        $sql = "SELECT * FROM element WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $element = new Element();
        $element->setId($row['id']);
        $element->setName($row['name']);
        $element->setUrlImg($row['url_img']);
        return $element;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM element";
        $stmt = $this->execRequest($sql);
        $list = [];

        while ($row = $stmt->fetch()) {
            $element = new Element();
            $element->setId($row['id']);
            $element->setName($row['name']);
            $element->setUrlImg($row['url_img']);
            $list[] = $element;
        }

        return $list;
    }

    public function create(Element $element): void
    {
        $sql = "INSERT INTO element (name, url_img) VALUES (:name, :url_img)";

        $params = [
            "name"    => $element->getName(),
            "url_img" => $element->getUrlImg()
        ];

        $this->execRequest($sql, $params);
    }

}