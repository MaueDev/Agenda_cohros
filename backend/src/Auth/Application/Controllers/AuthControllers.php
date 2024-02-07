<?php
namespace Agenda\Auth\Application\Controllers;

use Agenda\Auth\Application\Action\AuthAction;
use Slim\App;

class AuthControllers{

    public static function routes(App $app): App {
        $app->post('/auth', AuthAction::class);

        return $app;
    }
}