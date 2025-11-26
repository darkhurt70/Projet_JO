<?php
namespace Helpers;

class Logger
{
    // Chemin vers le dossier de logs
    private static $logDir = __DIR__ . '/../logs';

    /**
     * Écrit une entrée dans le fichier de log du mois courant.
     *
     * @param string $action Type d’action (ex: CREATE, DELETE)
     * @param string $entity Type d’entité concernée (ex: Personnage, Element)
     * @param string $message Description du log
     */
    public static function log($action, $entity, $message)
    {
        // Création du dossier s'il n'existe pas
        if (!is_dir(self::$logDir)) {
            mkdir(self::$logDir, 0777, true);
        }

        // Nom du fichier : MIHOYO_MM_YYYY.log
        $date = new \DateTime();
        $filename = 'MIHOYO_' . $date->format('m_Y') . '.log';
        $filePath = self::$logDir . '/' . $filename;

        // Construction de la ligne de log
        $logLine = '[' . $date->format('Y-m-d H:i:s') . '] [' . strtoupper($action) . '] [' . ucfirst($entity) . '] ' . $message . "\n";

        // Ajout de la ligne dans le fichier (en mode append)
        file_put_contents($filePath, $logLine, FILE_APPEND);
    }

    /**
     * Retourne une liste des fichiers de logs disponibles.
     *
     * @return array Liste des noms de fichiers .log
     */
    public static function listLogFiles()
    {
        // Si le dossier n'existe pas, retourne une liste vide
        if (!is_dir(self::$logDir)) return [];

        // Filtre uniquement les fichiers .log dans le dossier
        return array_values(array_filter(scandir(self::$logDir), function ($file) {
            return substr($file, -4) === '.log';
        }));
    }

    /**
     * Lit le contenu d’un fichier de log donné.
     *
     * @param string $filename Nom du fichier à lire (ex: MIHOYO_11_2025.log)
     * @return string Contenu du fichier, ou chaîne vide si absent
     */
    public static function readLogFile($filename)
    {
        $filePath = self::$logDir . '/' . $filename;
        return file_exists($filePath) ? file_get_contents($filePath) : '';
    }
}
