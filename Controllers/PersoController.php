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
        // TODO: faire la suppression réelle
        $message = "Le personnage avec l'ID $id a été supprimé.";
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => [], // à remplacer plus tard par $dao->getAll()
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



}
