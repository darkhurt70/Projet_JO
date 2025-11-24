<?php

namespace Services;

use Models\Element;
use Models\Origin;
use Models\Personnage;
use Models\UnitClass;

class PersonnageService {
    public static function hydrate(array $data, Element $element, Origin $origin, UnitClass $unit): Personnage {
        $p = new Personnage();

        $p->setId($data['id']);
        $p->setName($data['name']);
        $p->setElement($element);
        $p->setUnitclass($unit);
        $p->setRarity((int)$data['rarity']);
        $p->setOrigin($origin);
        $p->setUrlImg($data['url_img']);

        return $p;
    }
}
