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
use Helpers\Logger;

/**
 * Contrôleur responsable de la gestion des attributs (Origin, Element, UnitClass).
 */

class AttributController
{
    private Engine $templates;
    private OriginDAO $originDAO;
    private ElementDAO $elementDAO;
    private UnitClassDAO $unitClassDAO;

    /**
     * Contrôleur responsable de la gestion des attributs (Origin, Element, UnitClass).
     */
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->originDAO = new OriginDAO();
        $this->elementDAO = new ElementDAO();
        $this->unitClassDAO = new UnitClassDAO();
    }
    /**
     * Affiche le formulaire d'ajout d'attributs.
     *
     * @param Message|null $message Message à afficher sur la page (succès, erreur...).
     */
    public function displayAddAttribute($message = null): void
    {
        echo $this->templates->render("add-attribute", [
            "message" => $message,
            "gameName" => "Genshin Impact"
        ]);
    }

    /**
     * Gère l'ajout d'un nouvel attribut (Origin, Element ou UnitClass).
     *
     * @param string $type Le type d'attribut à ajouter (origin | element | unitclass)
     * @param string $name Le nom de l'attribut
     * @param string $url  L'URL de l'image associée à l'attribut
     */

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
                // Type invalide → message d'erreur
                $this->displayAddAttribute(new Message("Type d'attribut invalide.", Message::COLOR_ERROR, "Erreur"));
                return;

        }

        // 🔍 Vérifier les doublons (même nom)
        $existing = array_filter($dao->getAll(), function ($item) use ($name) {
            return strtolower($item->getName()) === strtolower($name);
        });

        if (!empty($existing)) {
            Logger::log('CREATE', ucfirst($type), "Échec : doublon sur le nom '$name'");
            $this->displayAddAttribute(new Message("Cet attribut existe déjà.", Message::COLOR_ERROR, "Doublon"));
            return;
        }





        // Création de l'objet correspondant au type
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

        // Sauvegarde dans la BDD via le DAO
        $dao->create($attribute);

        // log
        Logger::log('CREATE', ucfirst($type), "Ajout de l'attribut : $name");


        // Affichage de la page d'accueil avec message de succès
        $persoDAO = new \Models\PersonnageDAO();
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'message' => new Message($successMsg, Message::COLOR_SUCCESS, "Succès"),
            'listPersonnage' => $persoDAO->getAll()
        ]);

    }}
