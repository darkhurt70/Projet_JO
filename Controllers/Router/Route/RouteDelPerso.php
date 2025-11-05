<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteDelPerso extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        $id = $this->getParam($params, 'id', false);
        return $this->controller->deletePerso($id);
    }

    public function post(array $params = []) {}
}
