<?php

use Agenda\Auth\Application\Controllers\AuthControllers;
use Agenda\Auth\Application\DI\AuthInjector;
use Agenda\Core\Application\Middleware\ErrorHandler;
use Slim\App;
use Slim\Container;

require '../vendor/autoload.php';
//

$container = new Container;
$app = new App($container);

//Dependency Injection
AuthInjector::inject($app);

//Middleware
$app->add(new ErrorHandler());

//Routes
AuthControllers::routes($app);

$app->run();
