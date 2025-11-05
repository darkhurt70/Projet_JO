<?php

namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

class RouteLogin extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        return $this->controller->displayLogin();
    }

    public function post(array $params = [])
    {
        // À faire plus tard
    }
}
