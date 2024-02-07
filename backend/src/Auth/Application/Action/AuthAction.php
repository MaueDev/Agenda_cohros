<?php 

namespace Agenda\Auth\Application\Action;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AuthAction{
    public function __invoke(Request $request, Response $response, array $args) {
        var_dump($request);
    }
}