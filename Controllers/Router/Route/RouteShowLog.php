<?php

namespace Controllers\Router\Route;

use Controllers\LogController;
use Controllers\Router\Route;

class RouteShowLog extends Route
{
    private LogController $controller;

    public function __construct(LogController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        if (!isset($params['file'])) {
            $this->controller->displayLogs(); // Affiche juste la liste si aucun fichier n’est spécifié
        } else {
            $this->controller->showLogContent($params['file']);
        }
    }

    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
