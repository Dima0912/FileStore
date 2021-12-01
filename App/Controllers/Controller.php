<?php

namespace App;

use Exception;

class Controller{


    protected $routeParams = [];

    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;
    }
 
    public function __call(string $method, array $arguments)
    {
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func([$this, $method], $arguments);
                $this->after();
            }
        } else {
            throw new Exception("Method {$method} not found in controller" . get_class($this));
        }
    }

    public function before(): bool
    {
        return true;
    }

    public function after(): void {}
}