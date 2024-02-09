<?php
namespace Agenda\Contacts\Application\Controllers;

use Agenda\Auth\Application\Action\VerifyAuthenticateAction;
use Agenda\Auth\Application\Middleware\JwtAuthMiddleware;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Application\Action\GetContactsAction;
use Slim\App;

class ContactsControllers{

    public static function routes(App $app): App {
        $validarJwt = new Jwt();
        $jwtMiddleware = new JwtAuthMiddleware($validarJwt);

        $app->get('/contacts', GetContactsAction::class)->add($jwtMiddleware);
        return $app;
    }
}