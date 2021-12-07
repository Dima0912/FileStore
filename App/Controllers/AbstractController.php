<?php

namespace App\Controllers;

use framework\Interfaces\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    protected string $name;

    public function index()
    {
        echo 'I am AbstractController';
    }
}