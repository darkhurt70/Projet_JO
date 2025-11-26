<?php

namespace Controllers\Router\Route;

use Controllers\AttributController;
use Controllers\Router\Route;

/**
 * RouteAddAttribute
 * Représente la route "add-attribute", utilisée pour :
 * - Afficher le formulaire d'ajout d'attribut (GET)
 * - Traiter la soumission du formulaire (POST)
 */
class RouteAddAttribute extends Route
{
    // Contrôleur métier associé
    private AttributController $controller;

    /**
     * Constructeur : injection du contrôleur associé
     *
     * @param AttributController $controller
     */
    public function __construct(AttributController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Méthode appelée sur un accès en GET
     * Affiche simplement le formulaire vide pour ajouter un attribut.
     *
     * @param array $params
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddAttribute();
    }

    /**
     * Méthode appelée sur un accès en POST
     * Tente de récupérer les données du formulaire et d’ajouter l’attribut correspondant.
     *
     * @param array $params
     */
    public function post(array $params = []): void
    {
        try {
            // Récupère les paramètres obligatoires du formulaire
            $type = parent::getParam($params, 'type', false);      // element, origin ou unitclass
            $name = parent::getParam($params, 'name', false);
            $url = parent::getParam($params, 'url_img', false);

            // Transmet les données au contrôleur pour traitement
            $this->controller->addAttribute($type, $name, $url);

        } catch (\Exception $e) {
            // En cas d’erreur (paramètre manquant ou vide), affiche à nouveau le formulaire avec un message
            $this->controller->displayAddAttribute("Erreur : " . $e->getMessage());
        }
    }
}
