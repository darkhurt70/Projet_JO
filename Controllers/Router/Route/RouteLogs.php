<?php

namespace Controllers\Router\Route;

use Controllers\LogController;
use Controllers\Router\Route;

/**
 * RouteLogs
 * Gère l'affichage des fichiers de logs du système.
 */
class RouteLogs extends Route
{
    // Contrôleur des logs utilisé pour afficher les fichiers et leur contenu
    private LogController $controller;

    /**
     * Constructeur : injection du contrôleur LogController
     * @param LogController $controller
     */
    public function __construct(LogController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * GET : Affiche soit la liste des fichiers de logs, soit leur contenu
     * @param array $params Paramètres GET contenant éventuellement 'file'
     */
    public function get(array $params = [])
    {
        if (!isset($params['file'])) {
            // Aucun fichier spécifié : afficher la liste des fichiers
            $this->controller->displayLogs();
        } else {
            // Un fichier est spécifié : afficher son contenu
            $this->controller->showLogContent($params['file']);
        }
    }

    /**
     * POST : Redirige vers GET pour simplifier le comportement
     * Cela permet une soumission de formulaire si nécessaire.
     * @param array $params
     */
    public function post(array $params = [])
    {
        $this->get($params);
    }
}
