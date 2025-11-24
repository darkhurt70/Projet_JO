<?php

namespace Services;

use Models\UnitClass;


class UnitClassService {
    public static function hydrate(array $data): UnitClass {

        $e = new UnitClass();
        $e->setId($data['id']);
        $e->setName($data['name']);
        $e->setUrlImg($data['url_img']);

        return $e;
    }
}