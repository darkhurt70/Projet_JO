<?php

namespace Controllers\Router\Route;

use Controllers\AttributController;
use Controllers\Router\Route;

class RouteAddAttribute extends Route
{
    private AttributController $controller;

    public function __construct(AttributController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        // Affiche simplement le formulaire vide pour ajouter un attribut
        $this->controller->displayAddAttribute();
    }

    public function post(array $params = []): void
    {
        try {
            // Récupération des paramètres via getParam
            $type = parent::getParam($params, 'type', false);          // element, origin, unitclass
            $name = parent::getParam($params, 'name', false);
            $url = parent::getParam($params, 'url_img', false);

            $this->controller->addAttribute($type, $name, $url);

        } catch (\Exception $e) {
            $this->controller->displayAddAttribute("Erreur : " . $e->getMessage());
        }
    }
}