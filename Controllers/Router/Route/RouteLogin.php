<?php

namespace Controllers\Router\Route;

use Controllers\LoginController;
use Controllers\Router\Route;

/**
 * RouteLogin
 * Gère la page de connexion utilisateur.
 */
class RouteLogin extends Route
{
    // Le contrôleur chargé de la logique d'authentification
    private LoginController $controller;

    /**
     * Constructeur : injecte le LoginController
     * @param LoginController $controller
     */
    public function __construct(LoginController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Méthode exécutée pour une requête GET
     * Affiche le formulaire de connexion
     */
    public function get(array $params = []): void
    {
        $this->controller->showLoginForm();
    }

    /**
     * Méthode exécutée pour une requête POST
     * Tente de connecter l'utilisateur avec les données envoyées
     * @param array $params Données envoyées depuis le formulaire (username/password)
     */
    public function post(array $params = []): void
    {
        $this->controller->handleLogin($params);
    }
}
