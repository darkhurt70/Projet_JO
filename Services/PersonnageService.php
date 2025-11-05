<?php

namespace Services;

use Models\Personnage;

class PersonnageService {
    public static function hydrate(array $data): Personnage {
        $p = new Personnage();

        $p->setId($data['id']);
        $p->setName($data['name']);
        $p->setElement($data['element']);
        $p->setUnitclass($data['unitclass']);
        $p->setRarity((int)$data['rarity']);
        $p->setOrigin($data['origin']);
        $p->setUrlImg($data['url_img']);

        return $p;
    }
}
