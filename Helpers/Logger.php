<?php

namespace Helpers;

class Logger
{
    private static $logDir = __DIR__ . '/../../logs';

    public static function log($action, $entity, $message)
    {
        if (!is_dir(self::$logDir)) {
            mkdir(self::$logDir, 0777, true);
        }

        $date = new \DateTime();
        $filename = 'MIHOYO_' . $date->format('m_Y') . '.log';
        $filePath = self::$logDir . '/' . $filename;

        $logLine = '[' . $date->format('Y-m-d H:i:s') . '] [' . strtoupper($action) . '] [' . ucfirst($entity) . '] ' . $message . "\n";
        file_put_contents($filePath, $logLine, FILE_APPEND);
    }

    public static function listLogFiles()
    {
        if (!is_dir(self::$logDir)) return [];

        return array_values(array_filter(scandir(self::$logDir), function ($file) {
            return substr($file, -4) === '.log';
        }));
    }

    public static function readLogFile($filename)
    {
        $filePath = self::$logDir . '/' . $filename;
        return file_exists($filePath) ? file_get_contents($filePath) : '';
    }
}
