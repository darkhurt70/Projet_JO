<?php

namespace Controllers;

use Models\Personnage;
use League\Plates\Engine;
use Helpers\Message;
use Helpers\Logger;



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

        if ($success) {
            Logger::log('DELETE', 'Personnage', "Suppression du personnage avec l'ID : $id");
            $message = new Message("Personnage supprimé avec succès ", Message::COLOR_SUCCESS, "Succès");
        } else {
            Logger::log('DELETE', 'Personnage', "Échec de la suppression : ID $id introuvable");
            $message = new Message("Aucun personnage trouvé avec cet ID.", Message::COLOR_ERROR, "Erreur");
        }

        echo $this->templates->render('home', [
            'listPersonnage' => $dao->getAll(),
            'message' => $message,
            'gameName' => 'Genshin Impact'
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
            Logger::log('CREATE', 'Personnage', "Ajout du personnage '{$personnage->getName()}' (ID: $id)");

            // 4. Message + affichage
            $message = new Message("Personnage ajouté avec succès ✅", Message::COLOR_SUCCESS, "Succès");
            echo $this->templates->render('home', [
                'message' => $message,
                'listPersonnage' => $dao->getAll(),
                'gameName' => 'Genshin Impact'
            ]);

        } catch (\Exception $e) {
            $message = new Message($e->getMessage(), essage::COLOR_ERROR, "Erreur");
            echo $this->templates->render('add-perso', [
                'message' => $message,
                'gameName' => 'Genshin Impact'
            ]);
        }
    }

    public function deletePersoAndIndex(?string $id = null): void
    {
        $dao = new \Models\PersonnageDAO();

        if ($id !== null) {
            $success = $dao->deletePerso($id);
            if ($success) {
                Logger::log('DELETE', 'Personnage', "Suppression du personnage avec l'ID : $id");
                $message = new Message("Personnage supprimé avec succès ✅", Message::COLOR_SUCCESS, "Succès");
            } else {
                Logger::log('DELETE', 'Personnage', "Échec de la suppression : ID $id introuvable");
                $message = new Message("Aucun personnage trouvé avec cet ID.", Message::COLOR_ERROR, "Erreur");
            }
        } else {
            Logger::log('DELETE', 'Personnage', "Tentative de suppression échouée : aucun ID fourni");
            $message = new Message("Aucun identifiant fourni.", Message::COLOR_ERROR, "Erreur");
        }

        echo $this->templates->render('home', [
            'message' => $message,
            'listPersonnage' => $dao->getAll(),
            'gameName' => 'Genshin Impact'
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
        Logger::log('UPDATE', 'Personnage', "Modification du personnage '{$personnage->getName()}' (ID: {$personnage->getId()})");

        $message = new Message("Personnage modifié avec succès ✅", Message::COLOR_SUCCESS, "Succès");

        echo $this->templates->render('home', [
            'listPersonnage' => $dao->getAll(),
            'gameName' => 'Genshin Impact',
            'message' => $message
        ]);
    }





}
