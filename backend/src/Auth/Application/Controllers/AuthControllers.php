<?php

declare(strict_types=1);

namespace Agenda\Auth\Application\Controllers;

use Agenda\Auth\Application\Action\AuthenticationAction;
use Agenda\Auth\Application\Action\VerifyAuthenticateAction;
use Slim\App;

class AuthControllers
{
    public static function routes(App $app): App
    {
        $app->post('/auth', AuthenticationAction::class);
        $app->get('/auth/verify', VerifyAuthenticateAction::class);
        return $app;
    }
}
