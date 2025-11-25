<?php
namespace Controllers\Router;

use Controllers\MainController;
use Controllers\PersoController;
use Controllers\AttributController;

use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteAddAttribute;



class Router
{
    private array $routeList = [];
    private array $ctrlList = [];
    private string $actionKey;

    public function __construct(string $actionKey = "action")
    {
        $this->actionKey = $actionKey;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList(): void
    {
        $this->ctrlList["main"] = new MainController();
        $this->ctrlList["perso"] = new PersoController();
        $this->ctrlList["attribut"] = new AttributController();

    }

    private function createRouteList(): void
    {
        $this->routeList["index"] = new RouteIndex($this->ctrlList["main"]);
        $this->routeList["add-perso"] = new RouteAddPerso($this->ctrlList["perso"]);
        $this->routeList["logs"] = new RouteLogs($this->ctrlList["main"]);
        $this->routeList["login"] = new RouteLogin($this->ctrlList["main"]);
        $this->routeList["del-perso"] = new RouteDelPerso($this->ctrlList["perso"]);
        $this->routeList["edit-perso"] = new RouteEditPerso($this->ctrlList["perso"]);
        $this->routeList["add-attribute"] = new RouteAddAttribute($this->ctrlList["attribut"]);




    }

    public function routing(array $get, array $post): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $params = $method === 'POST' ? $post : $get;

        $action = $get[$this->actionKey] ?? "index";

        if (!array_key_exists($action, $this->routeList)) {
            $action = "index";
        }

        $this->routeList[$action]->action($params, $method);
    }
}
