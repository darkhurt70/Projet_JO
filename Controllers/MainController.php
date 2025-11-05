<?php

namespace Controllers;
use League\Plates\Engine;
use Models\PersonnageDAO;
class MainController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function index(): void {
        $dao = new PersonnageDAO();

        $listPersonnage = $dao->getAll(); // tableau de Personnage
        $first = $dao->getByID('perso001'); // un personnage qui existe
        $other = $dao->getByID('idInexistant'); // null attendu

        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'first' => $first,
            'other' => $other
        ]);
    }

    public function displayLogs(): void
    {
        echo $this->templates->render('logs');
    }


    public function displayLogin(): void
    {
        echo $this->templates->render('login');
    }




}