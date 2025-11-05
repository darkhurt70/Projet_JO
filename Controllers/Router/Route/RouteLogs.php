<?php

namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

class RouteLogs extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        return $this->controller->displayLogs();
    }

    public function post(array $params = [])
    {
        // Rien à faire ici pour le moment
    }
}
