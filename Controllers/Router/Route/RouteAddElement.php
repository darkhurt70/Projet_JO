<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteAddElement extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        return $this->controller->displayAddElement();
    }

    public function post(array $params = [])
    {
        // plus tard
    }
}
