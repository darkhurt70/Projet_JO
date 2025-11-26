<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

/**
 * RouteEditPerso
 * Gère la modification d’un personnage existant.
 */
class RouteEditPerso extends Route
{
    // Référence au contrôleur métier des personnages
    private PersoController $controller;

    /**
     * Constructeur avec injection du contrôleur
     */
    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Méthode GET : Affiche le formulaire d’édition d’un personnage
     */
    public function get(array $params = []): void
    {
        try {
            // Récupère l’ID du personnage à modifier
            $id = parent::getParam($params, 'id', false);

            // Appelle le contrôleur pour afficher le formulaire avec les données
            $this->controller->displayEditPerso($id);
        } catch (\Exception $e) {
            // En cas d’absence d’ID, affiche le formulaire avec message d’erreur
            $this->controller->displayEditPerso(null, "ID manquant pour l'édition.");
        }
    }

    /**
     * Méthode POST : Valide et enregistre les modifications
     */
    public function post(array $params = []): void
    {
        echo "test"; // Peut être retiré si utilisé uniquement pour debug

        try {
            // Récupère et valide tous les champs du formulaire
            $data = [
                "id"        => parent::getParam($params, "id", false),
                "name"      => parent::getParam($params, "perso-nom", false),
                "element"   => parent::getParam($params, "perso-element", false),
                "origin"    => parent::getParam($params, "perso-origin", false),
                "unitclass" => parent::getParam($params, "perso-class", false),
                "rarity"    => parent::getParam($params, "perso-rarity", false),
                "url_img"   => parent::getParam($params, "perso-url", false),
            ];

            // Appelle le contrôleur pour sauvegarder les modifications
            $this->controller->editPersoAndIndex($data);

        } catch (\Exception $e) {
            // En cas d’erreur de formulaire, réaffiche le formulaire avec message
            $this->controller->displayEditPerso(null, "Erreur : tous les champs sont requis.");
        }
    }
}
