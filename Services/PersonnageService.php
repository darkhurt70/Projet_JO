<?php
namespace Services;

use Models\Element;
use Models\Origin;
use Models\Personnage;
use Models\UnitClass;

/**
 * Service utilitaire pour hydrater un objet Personnage avec ses dépendances.
 */
class PersonnageService
{
    /**
     * Construit un objet Personnage à partir d’un tableau de données et de ses objets liés.
     *
     * @param array $data Données brutes du personnage (provenant de la BDD)
     * @param Element $element Objet Element déjà récupéré (clé étrangère)
     * @param Origin $origin Objet Origin déjà récupéré (clé étrangère)
     * @param UnitClass $unit Objet UnitClass déjà récupéré (clé étrangère)
     * @return Personnage Objet Personnage prêt à l’emploi
     */
    public static function hydrate(array $data, Element $element, Origin $origin, UnitClass $unit): Personnage
    {
        $p = new Personnage();

        $p->setId($data['id']);
        $p->setName($data['name']);
        $p->setElement($element); // Association avec l’objet Element
        $p->setUnitclass($unit); // Association avec l’objet UnitClass
        $p->setRarity((int)$data['rarity']);
        $p->setOrigin($origin);  // Association avec l’objet Origin
        $p->setUrlImg($data['url_img']);

        return $p;
    }
}
