<?php

namespace Services;

use Models\UnitClass;

/**
 * Service utilitaire pour construire un objet UnitClass à partir de données brutes.
 */
class UnitClassService
{
    /**
     * Hydrate un objet UnitClass à partir des données de la BDD.
     *
     * @param array $data Données brutes contenant les champs : id, name, url_img
     * @return UnitClass Objet UnitClass prêt à l'emploi
     */
    public static function hydrate(array $data): UnitClass
    {
        $e = new UnitClass();

        // Initialisation des propriétés depuis le tableau
        $e->setId($data['id']);
        $e->setName($data['name']);
        $e->setUrlImg($data['url_img']);

        return $e;
    }
}
