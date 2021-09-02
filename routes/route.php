<?php
require_once  '..\vendor\autoload.php';

use Core\Routing\Router;


$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('posts/index', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/{id:\d}', ['controller' => 'Posts', 'action' => 'show']);
