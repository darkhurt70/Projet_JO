<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

/**
 * RouteDelPerso
 * Gère la suppression d’un personnage via une requête GET.
 */
class RouteDelPerso extends Route
{
    // Contrôleur métier responsable des personnages
    private PersoController $controller;

    /**
     * Constructeur : injection du contrôleur Personnage
     */
    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Méthode GET : supprime un personnage à partir de son ID
     */
    public function get(array $params = [])
    {
        // Vérifie la présence du paramètre 'id' (obligatoire)
        $id = $this->getParam($params, 'id', false);

        // Appelle la méthode du contrôleur pour supprimer le personnage
        return $this->controller->deletePerso($id);
    }

    /**
     * Méthode POST non utilisée ici
     */
    public function post(array $params = []) {}
}
