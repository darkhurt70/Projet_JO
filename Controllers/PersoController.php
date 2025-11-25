<?php

namespace Controllers;

use Models\Personnage;
use League\Plates\Engine;

class PersoController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function displayAddPerso(?string $message = null): void
    {
        $elementDAO = new \Models\ElementDAO();
        $originDAO = new \Models\OriginDAO();
        $unitclassDAO = new \Models\UnitClassDAO();

        echo $this->templates->render('add-perso', [
            'message' => $message,
            'listElements' => $elementDAO->getAll(),
            'gameName' => 'Ajouter un personnage',
            'listOrigins' => $originDAO->getAll(),
            'listUnitClasses' => $unitclassDAO->getAll()
        ]);
    }


    public function displayAddElement(): void
    {

        echo $this->templates->render('add-element', [
            'gameName' => 'Genshin Impact'
        ]);
    }
    public function deletePerso(string $id): void
    {
        $dao = new \Models\PersonnageDAO();
        $success = $dao->deletePerso($id);

        $message = $success
            ? "Le personnage avec l'ID $id a été supprimé ✅"
            : "❌ Aucun personnage avec l'ID $id n’a été trouvé.";

        echo $this->templates->render('home', [
            'listPersonnage' => $dao->getAll(),
            'message' => $message
        ]);
    }


    public function redirectToEdit(string $id): void
    {

        header("Location: index.php?action=add-perso&id=" . urlencode($id));
        exit;
    }


    public function addPerso(array $data): void
    {
        try {

            $id = uniqid();
            $element = (new \Models\ElementDAO())->getByID($data['element']);
            $origin = (new \Models\OriginDAO())->getByID($data['origin']);
            $unit = (new \Models\UnitClassDAO())->getByID($data['unitclass']);

            $personnage = new Personnage();

            $personnage->setId($id);
            $personnage->setName($data['name']);
            $personnage->setElement($element);
            $personnage->setOrigin($origin);
            $personnage->setUnitclass($unit);
            $personnage->setRarity((int)$data['rarity']);
            $personnage->setUrlImg($data['url_img']);


            $dao = new \Models\PersonnageDAO();
            $dao->createPersonnage($personnage);

            // 4. Message + affichage
            echo $this->templates->render('home', [
                'message' => "Personnage ajouté avec succès ✅",
                'listPersonnage' => $dao->getAll(),
                'gameName' => 'Genshin Impact'
            ]);

        } catch (\Exception $e) {
            echo $this->templates->render('add-perso', [
                'message' => "Erreur : " . $e->getMessage(),
                'gameName' => 'Genshin Impact'
            ]);
        }
    }

    public function deletePersoAndIndex(?string $id = null): void
    {
        $dao = new \Models\PersonnageDAO();
        $message = "";

        if ($id !== null) {
            $success = $dao->deletePerso($id);
            $message = $success
                ? "Personnage supprimé avec succès ✅"
                : "Erreur : aucun personnage trouvé avec cet ID.";
        } else {
            $message = "Erreur : aucun identifiant fourni.";
        }

        echo $this->templates->render('home', [
            'message' => $message,
            'listPersonnage' => $dao->getAll()
        ]);
    }

    public function displayEditPerso(?string $id = null, ?string $message = null): void
    {
        $dao = new \Models\PersonnageDAO();
        $perso = $id ? $dao->getByID($id) : null;
        $elementDAO = new \Models\ElementDAO();
        $originDAO = new \Models\OriginDAO();
        $unitclassDAO = new \Models\UnitClassDAO();

        echo $this->templates->render('edit-perso', [
            'message' => $message,
            'perso' => $perso,
            'gameName' => 'Genshin Impact',
            'listElements' => $elementDAO->getAll(),
            'listOrigins' => $originDAO->getAll(),
            'listUnitClasses' => $unitclassDAO->getAll()
        ]);
    }

    public function editPersoAndIndex(array $data): void
    {
        $dao = new \Models\PersonnageDAO();
        $element = (new \Models\ElementDAO())->getByID($data['element']);
        $origin = (new \Models\OriginDAO())->getByID($data['origin']);
        $unit = (new \Models\UnitClassDAO())->getByID($data['unitclass']);

        $personnage = new Personnage();
        $personnage->setId($data['id']);
        $personnage->setName($data['name']);
        $personnage->setElement($element);
        $personnage->setUnitclass($unit);
        $personnage->setRarity((int)$data['rarity']);
        $personnage->setOrigin($origin);
        $personnage->setUrlImg($data['url_img']);

        $dao->updatePersonnage($personnage);

        echo $this->templates->render('home', [
            'listPersonnage' => $dao->getAll(),
            'gameName' => 'Genshin Impact',
            'message' => "✅ Personnage mis à jour avec succès !"
        ]);
    }





}
