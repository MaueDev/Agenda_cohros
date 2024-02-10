<?php

declare(strict_types=1);

namespace Agenda\Contacts\Application\Action;

use Agenda\Contacts\Domain\Dto\SaveContactsDto;
use Agenda\Contacts\Domain\Service\SaveContactsService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SaveContactsAction
{
    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $params                        = (array) $request->getParsedBody();
        $params['authorizationHeader'] = $request->getHeaderLine('Authorization');
        $saveContactsDto               = SaveContactsDto::fromArray($params);

        /** @var SaveContactsService $saveContactsService */
        $saveContactsService = $this->container->get(SaveContactsService::class);
        $saveContactsService->save($saveContactsDto);
        $response
            ->getBody()
            ->write(
                json_encode(
                    [
                        'status-code' => 200,
                    ]
                )
            );

        return $response;
    }
}
