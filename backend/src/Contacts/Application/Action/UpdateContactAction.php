<?php

declare(strict_types=1);

namespace Agenda\Contacts\Application\Action;

use Agenda\Contacts\Domain\Dto\UpdateContactDto;
use Agenda\Contacts\Domain\Service\UpdateContactService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateContactAction
{
    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $args = (array) $request->getParsedBody() + $args;

        $updateContactDto = UpdateContactDto::fromArray($args);

        /** @var UpdateContactService $updateContactService */
        $updateContactService = $this->container->get(UpdateContactService::class);
        $updateContactService->update($updateContactDto);
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
