<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteAddPerso extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        return $this->controller->displayAddPerso();
    }

    public function post(array $params = []): void
    {
        try {
            $data = [
                "name"      => parent::getParam($params, "perso-nom", false),
                "element"   => parent::getParam($params, "perso-element", false),
                "origin"    => parent::getParam($params, "perso-origin", false),
                "unitclass"=> parent::getParam($params, "perso-class", false),
                "rarity"    => parent::getParam($params, "perso-rarity", false),
                "url_img"   => parent::getParam($params, "perso-url", false),
            ];


            $this->controller->addPerso($data);

        } catch (\Exception $e) {

            $this->controller->displayAddPerso("Erreur : " . $e->getMessage());
        }
    }

}
