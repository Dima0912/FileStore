<?php

namespace Core;

use Core\Routing\RouteInterface;

class Application 
{
    protected object $router;

    public function __construct(RouteInterface $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $action = $this->router->route();
        $action();
    }
}