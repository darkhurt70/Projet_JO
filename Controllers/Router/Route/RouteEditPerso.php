<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteEditPerso extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        try {
            $id = parent::getParam($params, 'id', false);
            $this->controller->displayEditPerso($id);
        } catch (\Exception $e) {
            $this->controller->displayEditPerso(null, "ID manquant pour l'édition.");
        }
    }


    public function post(array $params = []): void
    {
        try {
            $data = [
                "id"        => parent::getParam($params, "perso-id", false),
                "name"      => parent::getParam($params, "perso-nom", false),
                "element"   => parent::getParam($params, "perso-element", false),
                "origin"    => parent::getParam($params, "perso-origin", false),
                "unitclass" => parent::getParam($params, "perso-class", false),
                "rarity"    => parent::getParam($params, "perso-rarity", false),
                "url_img"   => parent::getParam($params, "perso-url", false),
            ];
            $this->controller->editPersoAndIndex($data);
        } catch (\Exception $e) {
            $this->controller->displayEditPerso(null, "Erreur : tous les champs sont requis.");
        }
    }
}
