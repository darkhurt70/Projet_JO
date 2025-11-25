<?php

namespace Controllers;
use League\Plates\Engine;
use Models\PersonnageDAO;
use Helpers\Message;
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

        $message = null; // Par défaut aucun message

        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'first' => $first,
            'other' => $other,
            'message' => $message
        ]);
    }


    public function displayLogs(): void
    {
        $file = $_GET['file'] ?? null;
        $logFiles = \Helpers\Logger::listLogFiles();
        $selectedFile = $file ?? end($logFiles); // Dernier fichier si aucun sélectionné
        $logContent = $selectedFile ? \Helpers\Logger::readLogFile($selectedFile) : "Aucun fichier de log disponible.";

        echo $this->templates->render('logs', [
            'logFiles' => $logFiles,
            'selectedFile' => $selectedFile,
            'logContent' => $logContent
        ]);
    }



    public function displayLogin(): void
    {
        echo $this->templates->render('login');
    }





}