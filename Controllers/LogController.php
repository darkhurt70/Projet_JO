<?php

namespace Controllers;

use League\Plates\Engine;

class LogController
{
    private Engine $templates;
    private string $logDir;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->logDir = realpath(__DIR__ . '/../logs'); // 🔐 Sûr et absolu
    }

    public function displayLogs(): void
    {
        $files = $this->getLogFiles();

        echo $this->templates->render('logs', [
            'logFiles' => $files,
            'gameName' => 'Logs - Genshin Impact'
        ]);
    }

    public function showLogContent(string $file): void
    {
        $files = $this->getLogFiles(); // 📜 Reprend tous les fichiers

        $safeFile = basename($file); // 🔐 évite les chemins relatifs dangereux
        $fullPath = $this->logDir . DIRECTORY_SEPARATOR . $safeFile;

        if (!in_array($safeFile, $files)) {
            $content = "Fichier introuvable ou invalide.";
        } else {
            $content = file_exists($fullPath) ? file_get_contents($fullPath) : "Fichier vide.";
        }

        echo $this->templates->render('logs', [
            'logFiles' => $files,
            'logContent' => $content,
            'selectedFile' => $safeFile,
            'gameName' => 'Logs - Genshin Impact'
        ]);
    }

    private function getLogFiles(): array
    {
        if (!is_dir($this->logDir)) {
            return [];
        }

        $allFiles = scandir($this->logDir);
        $logFiles = [];

        foreach ($allFiles as $file) {
            if (preg_match('/^MIHOYO_\d{2}_\d{4}\.log$/', $file)) {
                $logFiles[] = $file;
            }
        }

        sort($logFiles); // Optionnel : trie par ordre croissant
        return $logFiles;
    }
}
