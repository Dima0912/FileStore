<?php

namespace framework\Components\Router;


use app\Controllers\HomeController;
use app\Controllers\PageController;
use app\Controllers\Page404Controller;
use framework\Interfaces\RouterInterface;


class Router implements RouterInterface
{
    private string $uri;
    private array $segments;
    private string $controller;
    private ?string $method = NULL;
    private ?array $param = NULL;
    private string $controllerNamespace = 'app\\Controllers\\';

    public function __construct()
    {
        $this->uri = mb_strtolower($_SERVER["REQUEST_URI"]);
        $this->segments  = explode('/', $this->uri);
        $this->controller = $this->segments[1];

        if ($this->segments[1])
        {
            $this->method = $this->segments[2];
        }
        if ($this->segments[3])
        {
            $this->param[$this->segments[3]] = $this->segments[4];
        }

    }

    public function route(): callable
    {

        if ($_SERVER['REQUEST_URI'] == '/') {
            $controller = new HomeController();
            return [$controller, 'index'];
        }

        $classNamespace = $this->controllerNamespace . ucfirst($this->controller) . 'Controller';

        if ($_SERVER['REQUEST_URI'] == '/' . $this->controller . '/') {

            $controller = new $classNamespace($this->param);
            return [$controller, 'index'];
        }
            $controller = new Page404Controller();
            return [$controller, 'index'];
    }
}