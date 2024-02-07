<?php
namespace Agenda\Auth\Application\Controllers;

use Agenda\Auth\Application\Action\AuthLoginAction;
use Slim\App;

class AuthControllers{

    public static function routes(App $app): App {
        $app->post('/auth', AuthLoginAction::class);

        return $app;
    }
}