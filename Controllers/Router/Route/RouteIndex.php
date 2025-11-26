<?php

namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

/**
 * RouteIndex
 * Gère la page d’accueil de l'application.
 */
class RouteIndex extends Route
{
    // Le contrôleur qui contient la logique métier liée à l'accueil
    private MainController $controller;

    /**
     * Constructeur de la route
     * @param MainController $controller Le contrôleur principal à utiliser
     */
    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Appelé lors d’une requête GET
     * Affiche la page d’accueil
     */
    public function get(array $params = [])
    {
        return $this->controller->index();
    }

    /**
     * Appelé lors d’une requête POST
     * Ici, il n’y a pas de formulaire sur la page d’accueil,
     * donc on redirige également vers l’index.
     */
    public function post(array $params = [])
    {
        return $this->controller->index();
    }
}
