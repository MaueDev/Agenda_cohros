<?php 

namespace Agenda\Auth\Application\Action;

use Agenda\Auth\Domain\Dto\AuthLoginDto;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AuthLoginAction{
    public function __invoke(Request $request, Response $response, array $args) {
        $params = (array)$request->getParsedBody();
        $paramsDto = AuthLoginDto::fromArray($params);

        var_dump($paramsDto);
    }
}