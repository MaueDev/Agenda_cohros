<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Service;

use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Domain\Dto\SaveContactsDto;
use Agenda\Contacts\Domain\Entity\Contacts;
use Agenda\Contacts\Domain\Repository\SaveContactsRepository;

class SaveContactsService
{
    public function __construct(
        private SaveContactsRepository $saveContactsRepository,
        private GetUsers $getUser,
        private Jwt $jwt
    ) {
    }

    public function save(SaveContactsDto $saveContactsDto): Contacts
    {
        $userData = $this->jwt->decode($saveContactsDto->getAuthorizationHeader());
        $user     = $this->getUser->getByNameAndEmail(
            $userData->data->name,
            $userData->data->email
        );

        $contacts = Contacts::setFromDto($saveContactsDto, $user);
        $this->saveContactsRepository->store($contacts);
        return $contacts;
    }
}
