<?php

use Agenda\Auth\Application\Controllers\AuthControllers;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app = AuthControllers::routes($app);

$app->run();
