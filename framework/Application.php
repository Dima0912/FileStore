<?php

namespace framework;

use framework\Interfaces\RouterInterface;
use framework\Interfaces\RunnableInterface;

class Application implements RunnableInterface
{
    protected object $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $action = $this->router->route();
        $action();
    }
}