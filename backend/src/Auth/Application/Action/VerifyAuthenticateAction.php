<?php

declare(strict_types=1);

namespace Agenda\Auth\Application\Action;

use Agenda\Auth\Domain\Dto\VerifyAuthenticateDto;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VerifyAuthenticateAction
{
    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $header    = $request->getHeaderLine('Authorization');
        $headerDto = VerifyAuthenticateDto::fromHeader($header);

        /** @var Jwt $jwt */
        $jwt     = $this->container->get(Jwt::class);
        $decoded = $jwt->validate($headerDto->getHeader());
        $response->getBody()->write((string) json_encode($decoded));
        return $response;
    }
}
