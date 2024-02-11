<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Service;

use Agenda\Contacts\Domain\Dto\DeleteContactDto;
use Agenda\Contacts\Domain\Entity\Contacts;
use Agenda\Contacts\Domain\ReadModel\GetContacts;
use Agenda\Contacts\Domain\Repository\ContactsRepository;

class DeleteContactService
{
    public function __construct(
        private ContactsRepository $saveContactsRepository,
        private GetContacts $getContacts,
    ) {
    }

    public function delete(DeleteContactDto $deleteContactDto): Contacts
    {
        $contact = $this->getContacts->getById($deleteContactDto->getId());
        $this->saveContactsRepository->remove($contact);
        return $contact;
    }
}
