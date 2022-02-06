<?php

namespace App\Controllers;

use framework\Interfaces\ControllerInterface;

class Page404Controller implements ControllerInterface
{

    public function index()
    {
      return '404 Page not found!';
    }
}