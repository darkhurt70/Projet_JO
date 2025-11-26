<?php
namespace Models;

use Models\Element;

// Inclusion des fichiers nécessaires (peut être géré automatiquement si l'autoload fonctionne correctement)
require_once 'BasePDODAO.php';
require_once 'Element.php';

class ElementDAO extends BasePDODAO
{
    /**
     * Récupère un élément à partir de son identifiant
     * @param int $id L'identifiant en base
     * @return Element|null L'objet trouvé ou null si non trouvé
     */
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

    /**
     * Récupère tous les éléments de la base
     * @return Element[] Un tableau d'objets Element
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM element";
        $stmt = $this->execRequest($sql);
        $list = [];

        // Pour chaque ligne, créer un objet Element
        while ($row = $stmt->fetch()) {
            $element = new Element();
            $element->setId($row['id']);
            $element->setName($row['name']);
            $element->setUrlImg($row['url_img']);
            $list[] = $element;
        }

        return $list;
    }

    /**
     * Insère un nouvel élément dans la base de données
     * @param Element $element L'objet à enregistrer
     */
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
