<?php

namespace Controllers\Router\Route;

use Controllers\LoginController;
use Controllers\Router\Route;

class RouteLogout extends Route
{
    private LoginController $controller;

    public function __construct(LoginController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->logout();
    }

    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
