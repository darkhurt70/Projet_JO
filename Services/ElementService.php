<?php

namespace Services;

use Models\Element;


class ElementService {
    public static function hydrate(array $data): Element {

        $e = new Element;
        $e->setId($data['id']);
        $e->setName($data['name']);
        $e->setUrlImg($data['url_img']);

        return $e;
    }
}