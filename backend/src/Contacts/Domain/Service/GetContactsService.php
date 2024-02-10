<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Service;

use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Domain\Dto\GetContatcsDto;
use Agenda\Contacts\Domain\ReadModel\GetContacts;

class GetContactsService
{
    public function __construct(
        private GetUsers $getUser,
        private GetContacts $getContacts,
        private Jwt $jwt
    ) {
    }

    public function getContacts(GetContatcsDto $getContatcsDto): array
    {
        $userData = $this->jwt->decode($getContatcsDto->getHeader());
        $user     = $this->getUser->getByNameAndEmail(
            $userData->data->name,
            $userData->data->email
        );
        return $this->getContacts->getByUser($user->getId());
    }
}
