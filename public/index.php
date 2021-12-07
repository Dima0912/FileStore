<?php

//ini_set('display_errors', 1);

//include $_SERVER['DOCUMENT_ROOT'] . '/' . '../vendor/autoload.php';

include '../vendor/autoload.php';

use \framework\Application;
use \framework\Components\Router\Router;


$app = new Application(new Router());
$app->run();