<?php

declare(strict_types=1);

namespace Agenda\Contacts\Application\Controllers;

use Agenda\Auth\Application\Middleware\JwtAuthMiddleware;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Application\Action\GetContactsAction;
use Agenda\Contacts\Application\Action\SaveContactsAction;
use Slim\App;

class ContactsControllers
{
    public static function routes(App $app): App
    {
        $validarJwt    = new Jwt();
        $jwtMiddleware = new JwtAuthMiddleware($validarJwt);

        $app->get('/contacts', GetContactsAction::class)->add($jwtMiddleware);
        $app->post('/contacts', SaveContactsAction::class)->add($jwtMiddleware);
        return $app;
    }
}
