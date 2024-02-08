<?php 

namespace Agenda\Auth\Application\Action;

use Agenda\Auth\Domain\Dto\AuthenticationDto;
use Agenda\Auth\Domain\Dto\VerifyAuthenticateDto;
use Agenda\Auth\Domain\Services\AuthenticationService;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class VerifyAuthenticateAction{

    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function __invoke(Request $request, Response $response, array $args) {
        $header = $request->getHeaderLine('Authorization');
        $headerDto = VerifyAuthenticateDto::fromHeader($header);

        /** @var Jwt $jwt */
        $jwt = $this->container->get(Jwt::class);
        $decoded = $jwt->validate($headerDto->getHeader());
        $response->getBody()->write(json_encode($decoded));
        return $response;
    }
}