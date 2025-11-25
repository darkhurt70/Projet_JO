<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteAddElement extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        return $this->controller->displayAddElement();
    }

    public function post(array $params = []): void
    {
        $type = $params['type'] ?? '';
        $name = trim($params['name'] ?? '');
        $url = trim($params['url_img'] ?? '');

        // Choix du DAO
        $dao = match ($type) {
            'element' => new \Models\ElementDAO(),
            'origin' => new \Models\OriginDAO(),
            'unitclass' => new \Models\UnitClassDAO(),
            default => null
        };

        if (!$dao || !$name || !$url) {
            $this->controller->displayAddElement("❌ Données invalides.");
            return;
        }

        // Vérifier si le nom existe déjà
        $exists = array_filter($dao->getAll(), function ($item) use ($name) {
            return strtolower($item->getName()) === strtolower($name);
        });

        if (!empty($exists)) {
            $this->controller->displayAddElement("❌ Attribut déjà existant.");
            return;
        }

        // Créer l’attribut
        $attribute = match ($type) {
            'element' => new \Models\Element($name, $url),
            'origin' => new \Models\Origin($name, $url),
            'unitclass' => new \Models\UnitClass($name, $url)
        };

        $dao->create($attribute);

        // Retour à home avec message
        $personnageDAO = new \Models\PersonnageDAO();

        echo $this->controller->render('home', [
            'gameName' => 'Genshin Impact',
            'message' => "✅ Attribut ajouté avec succès.",
            'listPersonnage' => $personnageDAO->getAll()
        ]);
    }

}
