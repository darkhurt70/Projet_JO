<?php
namespace Controllers\Router;

// Importation des contrôleurs utilisés dans les routes
use Controllers\MainController;
use Controllers\PersoController;
use Controllers\AttributController;
use Controllers\LogController;
use Controllers\LoginController;

// Importation des routes associées aux actions
use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteAddAttribute;
use Controllers\Router\Route\RouteLogout;

/**
 * Le Router centralise les routes accessibles via l'URL (ex: ?action=add-perso).
 * Il associe une action à une Route, laquelle appelle un contrôleur.
 */
class Router
{
    private array $routeList = []; // Liste des routes accessibles
    private array $ctrlList = [];  // Liste des contrôleurs instanciés
    private string $actionKey;     // Clé GET utilisée pour déclencher une action (ex: "action")

    /**
     * Initialise le Router avec la clé GET (par défaut : action)
     */
    public function __construct(string $actionKey = "action")
    {
        $this->actionKey = $actionKey;
        $this->createControllerList(); // Instancie les contrôleurs
        $this->createRouteList();      // Associe les routes aux actions
    }

    /**
     * Instancie tous les contrôleurs nécessaires du projet
     */
    private function createControllerList(): void
    {
        $this->ctrlList["main"] = new MainController();
        $this->ctrlList["perso"] = new PersoController();
        $this->ctrlList["attribut"] = new AttributController();
        $this->ctrlList["log"] = new LogController();
        $this->ctrlList["login"] = new LoginController();
    }

    /**
     * Crée la correspondance entre les noms d’actions (ex: index, add-perso)
     * et les routes qui utilisent les bons contrôleurs.
     */
    private function createRouteList(): void
    {
        $this->routeList["index"] = new RouteIndex($this->ctrlList["main"]);
        $this->routeList["add-perso"] = new RouteAddPerso($this->ctrlList["perso"]);
        $this->routeList["del-perso"] = new RouteDelPerso($this->ctrlList["perso"]);
        $this->routeList["edit-perso"] = new RouteEditPerso($this->ctrlList["perso"]);
        $this->routeList["add-attribute"] = new RouteAddAttribute($this->ctrlList["attribut"]);
        $this->routeList["logs"] = new RouteLogs($this->ctrlList["log"]);
        $this->routeList["login"] = new RouteLogin($this->ctrlList["login"]);
        $this->routeList["logout"] = new RouteLogout($this->ctrlList["login"]);
    }

    /**
     * Fonction principale du Router : analyse la requête, détecte l'action,
     * puis exécute la méthode correspondante dans la route liée.
     *
     * @param array $get  Les données $_GET
     * @param array $post Les données $_POST
     */
    public function routing(array $get, array $post): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET'; // Méthode HTTP (GET ou POST)
        $params = $method === 'POST' ? $post : $get;   // Paramètres associés

        $action = $get[$this->actionKey] ?? "index";   // Action souhaitée via URL (?action=...)

        // Si l'action n'existe pas dans les routes définies, on retourne à l'accueil
        if (!array_key_exists($action, $this->routeList)) {
            $action = "index";
        }

        // On exécute la méthode 'action' définie dans la classe de la route concernée
        $this->routeList[$action]->action($params, $method);
    }
}
