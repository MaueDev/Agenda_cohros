<?php

use Agenda\Auth\Application\Controllers\AuthControllers;
use Agenda\Core\Application\Middleware\ErrorHandler;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->add(new ErrorHandler());

$app = AuthControllers::routes($app);

$app->run();
