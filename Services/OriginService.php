<?php
namespace Services;

use Models\Origin;

/**
 * Service utilitaire pour créer des objets Origin à partir de données brutes.
 */
class OriginService
{
    /**
     * Hydrate un objet Origin à partir d’un tableau associatif.
     *
     * @param array $data Données provenant d’une requête SQL (ex. via PDO::fetch)
     * @return Origin Objet Origin initialisé
     */
    public static function hydrate(array $data): Origin
    {
        // Création d’un nouvel objet Origin
        $e = new Origin();

        // Remplissage des propriétés à partir des données SQL
        $e->setId($data['id']);
        $e->setName($data['name']);
        $e->setUrlImg($data['url_img']);

        return $e;
    }
}
