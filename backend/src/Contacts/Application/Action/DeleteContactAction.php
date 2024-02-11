<?php

declare(strict_types=1);

namespace Agenda\Contacts\Application\Action;

use Agenda\Contacts\Domain\Dto\DeleteContactDto;
use Agenda\Contacts\Domain\Service\DeleteContactService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteContactAction
{
    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $contactDto = DeleteContactDto::fromArray($args);

        /** @var DeleteContactService $deleteContactsService */
        $deleteContactsService = $this->container->get(DeleteContactService::class);
        $deleteContactsService->delete($contactDto);

        $response
            ->getBody()
            ->write(
                (string) json_encode(
                    [
                        'status-code' => 200,
                    ]
                )
            );

        return $response;
    }
}
