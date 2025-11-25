<?php


namespace Controllers;

use Models\Origin;
use Models\Element;
use Models\UnitClass;
use Models\OriginDAO;
use Models\ElementDAO;
use Models\UnitClassDAO;
use League\Plates\Engine;
use Helpers\Message;


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

    public function displayAddAttribute($message = null): void
    {
        echo $this->templates->render("add-attribute", [
            "message" => $message,
            "gameName" => "Genshin Impact"
        ]);
    }



    public function addAttribute(string $type, string $name, string $url): void
    {
        $name = trim($name);
        $url = trim($url);

        // Récupération du DAO selon le type
        switch ($type) {
            case "origin":
                $dao = $this->originDAO;
                $successMsg = "Origine ajoutée avec succès.";
                break;

            case "element":
                $dao = $this->elementDAO;
                $successMsg = "Élément ajouté avec succès.";
                break;

            case "unitclass":
                $dao = $this->unitClassDAO;
                $successMsg = "Classe ajoutée avec succès.";
                break;

            default:
                $this->displayAddAttribute(new Message("Type d'attribut invalide.", Message::COLOR_ERROR, "Erreur"));
                return;

        }

        // 🔍 Vérifier les doublons (même nom)
        $existing = array_filter($dao->getAll(), function ($item) use ($name) {
            return strtolower($item->getName()) === strtolower($name);
        });

        if (!empty($existing)) {
            $this->displayAddAttribute(new Message("Cet attribut existe déjà.", Message::COLOR_ERROR, "Doublon"));
            return;
        }


        // Création de l’objet
        switch ($type) {
            case "origin":
                $attribute = new Origin($name, $url);
                break;
            case "element":
                $attribute = new Element($name, $url);
                break;
            case "unitclass":
                $attribute = new UnitClass($name, $url);
                break;
        }

        // Sauvegarde
        $dao->create($attribute);

        // ⬅️ Retour vers home avec message
        $persoDAO = new \Models\PersonnageDAO();
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'message' => new Message($successMsg, Message::COLOR_SUCCESS, "Succès"),
            'listPersonnage' => $persoDAO->getAll()
        ]);

    }}
