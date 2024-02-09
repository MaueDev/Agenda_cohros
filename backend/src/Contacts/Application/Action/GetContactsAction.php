<?php 

namespace Agenda\Contacts\Application\Action;

use Agenda\Contacts\Domain\Dto\GetContatcsDto;
use Agenda\Contacts\Domain\Entity\Contacts;
use Agenda\Contacts\Domain\Service\GetContactsService;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class GetContactsAction{

    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function __invoke(Request $request, Response $response, array $args) {
        $header = $request->getHeaderLine('Authorization');
        $headerDto = GetContatcsDto::fromHeader($header);
        /** @var GetContactsService $getContactsService */
        $getContactsService = $this->container->get(GetContactsService::class);
        $contacts = $getContactsService->getContacts($headerDto);

        $response->getBody()
                ->write(json_encode(
                    array_map(function(Contacts $contact){
                        return $contact->getAllValues();
                    }, $contacts)
                ));
        return $response;
    }
}