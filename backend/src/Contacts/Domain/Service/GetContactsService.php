<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Service;

use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Domain\Dto\GetContactsDto;
use Agenda\Contacts\Domain\ReadModel\GetContacts;

class GetContactsService
{
    public function __construct(
        private GetUsers $getUser,
        private GetContacts $getContacts,
        private Jwt $jwt
    ) {
    }

    public function getContacts(GetContactsDto $getContactsDto): ?array
    {
        $userData = $this->jwt->decode($getContactsDto->getHeader());
        $user     = $this->getUser->getByNameAndEmail(
            $userData->data->name,
            $userData->data->email
        );
        return $this->getContacts->getByUser($user->getId());
    }
}
