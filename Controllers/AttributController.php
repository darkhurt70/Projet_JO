<?php


namespace Controllers;

use Models\Origin;
use Models\Element;
use Models\UnitClass;
use Models\OriginDAO;
use Models\ElementDAO;
use Models\UnitClassDAO;
use League\Plates\Engine;

class AttributController
{
    private Engine $templates;
    private OriginDAO $originDAO;
    private ElementDAO $elementDAO;
    private UnitClassDAO $unitClassDAO;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->originDAO = new OriginDAO();
        $this->elementDAO = new ElementDAO();
        $this->unitClassDAO = new UnitClassDAO();
    }

    public function displayAddAttribute(string $message = ""): void
    {
        echo $this->templates->render("add-attribute", [
            "message" => $message
        ]);
    }

    public function addAttribute(string $type, string $name, string $url): void
    {
        $message = "";

        switch ($type) {
            case "origin":
                $attribute = new Origin($name, $url);  // constructeur simple
                $this->originDAO->create($attribute);
                $message = "Origine ajoutée avec succès.";
                break;

            case "element":
                $attribute = new Element($name, $url);
                $this->elementDAO->create($attribute);
                $message = "Élément ajouté avec succès.";
                break;

            case "unitclass":
                $attribute = new UnitClass($name, $url);
                $this->unitClassDAO->create($attribute);
                $message = "Classe ajoutée avec succès.";
                break;

            default:
                $message = "Type d'attribut invalide.";
        }

        // Retour au formulaire avec un message
        $this->displayAddAttribute($message);
    }
}