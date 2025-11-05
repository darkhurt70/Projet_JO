<?php

namespace Controllers;

use League\Plates\Engine;

class PersoController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function displayAddPerso(): void
    {
        echo $this->templates->render('add-perso');
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

}
