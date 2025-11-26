<?php
namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

/**
 * RouteAddPerso
 * Gère l’affichage et le traitement du formulaire d’ajout de personnage.
 */
class RouteAddPerso extends Route
{
    // Contrôleur associé
    private PersoController $controller;

    /**
     * Constructeur avec injection du PersoController
     */
    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Méthode GET : affiche le formulaire vide pour ajouter un personnage
     */
    public function get(array $params = [])
    {
        return $this->controller->displayAddPerso();
    }

    /**
     * Méthode POST : récupère et transmet les données du formulaire
     */
    public function post(array $params = []): void
    {
        try {
            // Récupération sécurisée des champs via getParam
            $data = [
                "name"       => parent::getParam($params, "perso-nom", false),
                "element"    => parent::getParam($params, "perso-element", false),
                "origin"     => parent::getParam($params, "perso-origin", false),
                "unitclass"  => parent::getParam($params, "perso-class", false),
                "rarity"     => parent::getParam($params, "perso-rarity", false),
                "url_img"    => parent::getParam($params, "perso-url", false),
            ];

            // Traitement via le contrôleur
            $this->controller->addPerso($data);

        } catch (\Exception $e) {
            // En cas d'erreur, affichage du formulaire avec le message d'erreur
            $this->controller->displayAddPerso("Erreur : " . $e->getMessage());
        }
    }
}
