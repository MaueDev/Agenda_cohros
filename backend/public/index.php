<?php

declare(strict_types=1);

use Agenda\Auth\Application\Controllers\AuthControllers;
use Agenda\Auth\Application\DI\AuthInjector;
use Agenda\Contacts\Application\Controllers\ContactsControllers;
use Agenda\Contacts\Application\DI\ContactsInjector;
use Agenda\Core\Application\DI\DoctrineInjector;
use Agenda\Core\Application\Middleware\ErrorHandler;
use Slim\App;
use Slim\Container;

require '../vendor/autoload.php';

$container = new Container();
$app       = new App($container);

//Dependency Injection
DoctrineInjector::inject($app);
AuthInjector::inject($app);
ContactsInjector::inject($app);

//Middleware
$app->add(new ErrorHandler());
//$app->add(new CorsMiddleware());

//Routes
AuthControllers::routes($app);
ContactsControllers::routes($app);

$app->run();
