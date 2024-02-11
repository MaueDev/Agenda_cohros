<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Service;

use Agenda\Contacts\Domain\Dto\UpdateContactDto;
use Agenda\Contacts\Domain\Entity\Contacts;
use Agenda\Contacts\Domain\ReadModel\GetContacts;
use Agenda\Contacts\Domain\Repository\SaveContactsRepository;

class UpdateContactService
{
    public function __construct(
        private SaveContactsRepository $saveContactsRepository,
        private GetContacts $getContacts,
    ) {
    }

    public function update(UpdateContactDto $updateContactDto): Contacts
    {
        $contact = $this->getContacts->getById($updateContactDto->getId());
        $contact->setUpdateFromDto($updateContactDto);
        $this->saveContactsRepository->store($contact);
        return $contact;
    }
}
