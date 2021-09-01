<?php
require_once  '..\vendor\autoload.php';

use Core\Routing\Router;

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts/index', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/{id:\d}', ['controller' => 'Posts', 'action' => 'show']);
