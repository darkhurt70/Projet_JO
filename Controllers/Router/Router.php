<?php
namespace Controllers\Router;

use Controllers\MainController;
use Controllers\PersoController;

use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;


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

    }

    private function createRouteList(): void
    {
        $this->routeList["index"] = new RouteIndex($this->ctrlList["main"]);
        $this->routeList["add-perso"] = new RouteAddPerso($this->ctrlList["perso"]);
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
