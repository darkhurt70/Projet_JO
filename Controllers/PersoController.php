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
        echo $this->templates->render('add-perso', [
            'message' => $message
        ]);
    }


    public function displayAddElement(): void
    {
        echo $this->templates->render('add-element');
    }
    public function deletePerso(string $id): void
    {
        $dao = new \Models\PersonnageDAO();
        $success = $dao->deletePerso($id);

        $message = $success
            ? "Le personnage avec l'ID $id a été supprimé ✅"
            : "❌ Aucun personnage avec l'ID $id n’a été trouvé.";

        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
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

            $personnage = new Personnage();

            $personnage->setId($id);
            $personnage->setName($data['name']);
            $personnage->setElement($data['element']);
            $personnage->setUnitclass($data['unitclass']);
            $personnage->setRarity((int)$data['rarity']);
            $personnage->setOrigin($data['origin']);
            $personnage->setUrlImg($data['url_img']);


            $dao = new \Models\PersonnageDAO();
            $dao->createPersonnage($personnage); // méthode à créer en 1.5

            // 4. Message + affichage
            echo $this->templates->render('home', [
                'message' => "Personnage ajouté avec succès ✅",
                'listPersonnage' => $dao->getAll()
            ]);

        } catch (\Exception $e) {
            echo $this->templates->render('add-perso', [
                'message' => "Erreur : " . $e->getMessage()
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




}
