<?php

declare(strict_types=1);

namespace Agenda\Contacts\Application\Action;

use Agenda\Contacts\Domain\Dto\GetContactDto;
use Agenda\Contacts\Domain\ReadModel\GetContacts;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetContactAction
{
    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $contactDto = GetContactDto::fromArray($args);

        /** @var GetContacts $getContacts */
        $getContacts = $this->container->get(GetContacts::class);
        $contact     = $getContacts->getById($contactDto->getId());

        $response->getBody()
                ->write((string) json_encode(
                    $contact->getAllValues()
                ));
        return $response;
    }
}
