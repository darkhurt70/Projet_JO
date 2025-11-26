<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

/**
 * RouteAddElement
 * Gère la route "add-element" : formulaire + traitement d'ajout
 */
class RouteAddElement extends Route
{
    // Contrôleur associé (ici le contrôleur personnage)
    private PersoController $controller;

    /**
     * Constructeur : injection du PersoController
     */
    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Méthode GET : affiche le formulaire d’ajout
     */
    public function get(array $params = [])
    {
        return $this->controller->displayAddElement();
    }

    /**
     * Méthode POST : traite l’envoi du formulaire d’ajout
     */
    public function post(array $params = []): void
    {
        // Récupération et nettoyage des champs
        $type = $params['type'] ?? '';
        $name = trim($params['name'] ?? '');
        $url = trim($params['url_img'] ?? '');

        // Sélection du DAO correspondant selon le type
        $dao = match ($type) {
            'element' => new \Models\ElementDAO(),
            'origin' => new \Models\OriginDAO(),
            'unitclass' => new \Models\UnitClassDAO(),
            default => null
        };

        // Vérifie que les données sont valides
        if (!$dao || !$name || !$url) {
            $this->controller->displayAddElement("❌ Données invalides.");
            return;
        }

        // Recherche d’un doublon sur le nom (insensible à la casse)
        $exists = array_filter($dao->getAll(), function ($item) use ($name) {
            return strtolower($item->getName()) === strtolower($name);
        });

        if (!empty($exists)) {
            $this->controller->displayAddElement("❌ Attribut déjà existant.");
            return;
        }

        // Création de l'objet selon le type
        $attribute = match ($type) {
            'element' => new \Models\Element($name, $url),
            'origin' => new \Models\Origin($name, $url),
            'unitclass' => new \Models\UnitClass($name, $url)
        };

        // Sauvegarde dans la base via le DAO
        $dao->create($attribute);

        // Retour vers la page d’accueil avec message de succès
        $personnageDAO = new \Models\PersonnageDAO();
        echo $this->controller->render('home', [
            'gameName' => 'Genshin Impact',
            'message' => "✅ Attribut ajouté avec succès.",
            'listPersonnage' => $personnageDAO->getAll()
        ]);
    }
}

