<?php

namespace Controllers\Router\Route;

use Controllers\LoginController;
use Controllers\Router\Route;

/**
 * RouteLogout
 * Gère la déconnexion de l'utilisateur.
 */
class RouteLogout extends Route
{
    // Contrôleur responsable de la logique de déconnexion
    private LoginController $controller;

    /**
     * Constructeur : injection du LoginController
     * @param LoginController $controller
     */
    public function __construct(LoginController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * GET : Déclenche la déconnexion via le contrôleur
     * @param array $params Non utilisé ici
     */
    public function get(array $params = []): void
    {
        $this->controller->logout();
    }

    /**
     * POST : redirige également vers la méthode GET pour la déconnexion
     * Permet une flexibilité si la déconnexion se fait via POST.
     * @param array $params Non utilisé
     */
    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
