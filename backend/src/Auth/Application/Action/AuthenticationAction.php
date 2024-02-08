<?php 

namespace Agenda\Auth\Application\Action;

use Agenda\Auth\Domain\Dto\AuthenticationDto;
use Agenda\Auth\Domain\Services\AuthenticationService;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AuthenticationAction{

    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function __invoke(Request $request, Response $response, array $args) {
        $params = (array)$request->getParsedBody();
        $paramsDto = AuthenticationDto::fromArray($params);
        /** @var AuthenticationService $authenticationService */
        $authenticationService = $this->container->get(AuthenticationService::class);
        $authetincation = $authenticationService->authenticate($paramsDto);
        $response->getBody()->write(json_encode($authetincation));
        return $response;
    }
}