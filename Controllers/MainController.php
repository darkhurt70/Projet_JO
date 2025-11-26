<?php

namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;
use Helpers\Message;

/**
 * Contrôleur principal du site.
 * Gère la page d'accueil, l'affichage des logs (version simple), et le formulaire de connexion.
 */
class MainController
{
    private Engine $templates;

    /**
     * Initialise le moteur de templates Plates.
     */
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    /**
     * Affiche la page d'accueil avec la liste des personnages.
     * Utilise PersonnageDAO pour récupérer les données.
     */
    public function index(): void {
        $dao = new PersonnageDAO();

        // Récupère tous les personnages
        $listPersonnage = $dao->getAll();

        // Récupère un personnage précis (à titre d'exemple/test)
        $first = $dao->getByID('perso001'); // Ce personnage doit exister
        $other = $dao->getByID('idInexistant'); // Simule une requête vide (résultat : null)

        $message = null; // Aucun message par défaut

        // Rend la vue avec les données
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'first' => $first,
            'other' => $other,
            'message' => $message
        ]);
    }

    /**
     * Affiche les logs (version alternative utilisant directement le Helper Logger).
     * Si aucun fichier n'est sélectionné, le dernier fichier trouvé est affiché par défaut.
     */
    public function displayLogs(): void
    {
        $file = $_GET['file'] ?? null;

        // Liste des fichiers de logs disponibles
        $logFiles = \Helpers\Logger::listLogFiles();

        // Fichier sélectionné : celui passé en paramètre ou le dernier de la liste
        $selectedFile = $file ?? end($logFiles);

        // Lecture du contenu du fichier sélectionné
        $logContent = $selectedFile ? \Helpers\Logger::readLogFile($selectedFile) : "Aucun fichier de log disponible.";

        // Rend la vue des logs
        echo $this->templates->render('logs', [
            'logFiles' => $logFiles,
            'selectedFile' => $selectedFile,
            'logContent' => $logContent
        ]);
    }

    /**
     * Affiche le formulaire de connexion utilisateur.
     * N'inclut aucun message par défaut.
     */
    public function displayLogin(): void
    {
        echo $this->templates->render('login');
    }
}
