<?php

namespace Services;

use Models\Origin;


class OriginService {
    public static function hydrate(array $data): Origin {

        $e = new Origin;
        $e->setId($data['id']);
        $e->setName($data['name']);
        $e->setUrlImg($data['url_img']);

        return $e;
    }
}