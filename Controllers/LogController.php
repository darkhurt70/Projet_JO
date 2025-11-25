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
        $this->logDir = __DIR__ . '/../logs';
    }
    private function getLogFiles(): array
    {
        if (!is_dir($this->logDir)) return [];

        return array_filter(scandir($this->logDir), function ($file) {
            return preg_match('/^MIHOYO_\d{2}_\d{4}\.log$/', $file);
        });
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
        $safeFile = basename($file);
        $fullPath = $this->logDir . '/' . $safeFile;

        $content = file_exists($fullPath)
            ? file_get_contents($fullPath)
            : "Fichier introuvable.";

        $files = array_filter(scandir($this->logDir), function ($file) {
            return preg_match('/^MIHOYO_\d{2}_\d{4}\.log$/', $file);
        });

        echo $this->templates->render('logs', [
            'logFiles' => $files,
            'logContent' => $content,
            'selectedFile' => $safeFile,
            'gameName' => 'Logs - Genshin Impact'
        ]);
    }

}
