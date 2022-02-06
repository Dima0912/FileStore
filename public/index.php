<?php


require '../vendor/autoload.php';

use framework\Application;
use \framework\Components\Router\Router;


$app = new Application(new Router());
$app->run();