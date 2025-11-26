<?php

namespace Controllers;

use League\Plates\Engine;

/**
 * Contrôleur chargé de la gestion et de l'affichage des fichiers de logs.
 */
class LogController
{
    private Engine $templates;
    private string $logDir;

    /**
     * Initialise le moteur de templates et définit le répertoire des logs.
     */
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->logDir = realpath(__DIR__ . '/../logs'); // Chemin absolu sécurisé vers le dossier logs
    }

    /**
     * Affiche la vue des logs avec la liste des fichiers de log disponibles.
     */
    public function displayLogs(): void
    {
        $files = $this->getLogFiles(); // Récupère les fichiers logs valides

        echo $this->templates->render('logs', [
            'logFiles' => $files,
            'gameName' => 'Logs - Genshin Impact'
        ]);
    }

    /**
     * Affiche le contenu d’un fichier log sélectionné.
     *
     * @param string $file Nom du fichier à afficher (ex: MIHOYO_11_2025.log)
     */
    public function showLogContent(string $file): void
    {
        $files = $this->getLogFiles(); // Liste des fichiers valides

        // Sécurité : empêche les chemins relatifs type '../etc/passwd'
        $safeFile = basename($file);
        $fullPath = $this->logDir . DIRECTORY_SEPARATOR . $safeFile;

        // Vérifie si le fichier demandé est bien dans la liste
        if (!in_array($safeFile, $files)) {
            $content = "Fichier introuvable ou invalide.";
        } else {
            $content = file_exists($fullPath) ? file_get_contents($fullPath) : "Fichier vide.";
        }

        // Affiche la vue avec contenu + liste des logs
        echo $this->templates->render('logs', [
            'logFiles' => $files,
            'logContent' => $content,
            'selectedFile' => $safeFile,
            'gameName' => 'Logs - Genshin Impact'
        ]);
    }

    /**
     * Récupère les fichiers de log présents dans le dossier /logs.
     *
     * Seuls les fichiers respectant le format MIHOYO_MM_YYYY.log sont pris en compte.
     *
     * @return array Liste des noms de fichiers log valides
     */
    private function getLogFiles(): array
    {
        if (!is_dir($this->logDir)) {
            return []; // Aucun répertoire trouvé
        }

        $allFiles = scandir($this->logDir);
        $logFiles = [];

        foreach ($allFiles as $file) {
            // Filtre sur le format attendu : MIHOYO_MM_YYYY.log
            if (preg_match('/^MIHOYO_\d{2}_\d{4}\.log$/', $file)) {
                $logFiles[] = $file;
            }
        }

        sort($logFiles); // Trie alphabétique
        return $logFiles;
    }
}
