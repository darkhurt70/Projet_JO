<?php

// Requires
use Controllers\MainController;
use League\Plates\Engine;
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';
require_once __DIR__ . '/Vendor/Plates/src/Engine.php';
require_once __DIR__ . '/Controllers/MainController.php';

// Créer une instance et enregistrer l'autoloader
$loader = new \Helpers\Psr4AutoloaderClass();
$loader->register();

// Enregistrer les namespace
$loader->addNamespace('\Helpers', 'Helpers');
$loader->addNamespace('\League\Plates', 'Vendor/Plates/src');
$loader->addNamespace('\Controllers', 'Controllers');

// Controllers
$controller = new MainController();
$controller->index();

// Instancier le moteur de templates
$templates = new League\Plates\Engine(__DIR__ . '/Views');

// Afficher la vue
//echo $templates->render('home', ['gameName' => 'Genshin Impact']);

