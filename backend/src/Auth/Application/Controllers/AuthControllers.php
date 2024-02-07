<?php
namespace Agenda\Auth\Application\Controllers;

use Agenda\Auth\Application\Action\AuthenticationAction;
use Slim\App;

class AuthControllers{

    public static function routes(App $app): App {
        $app->post('/auth', AuthenticationAction::class);

        return $app;
    }
}