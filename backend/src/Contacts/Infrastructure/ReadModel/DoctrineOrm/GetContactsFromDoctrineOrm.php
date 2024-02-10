<?php

declare(strict_types=1);

namespace Agenda\Contacts\Infrastructure\ReadModel\DoctrineOrm;

use Agenda\Auth\Domain\Exception\ContactsNotFound;
use Agenda\Contacts\Domain\Entity\Contacts;
use Agenda\Contacts\Domain\ReadModel\GetContacts;
use Doctrine\ORM\EntityManager;

class GetContactsFromDoctrineOrm implements GetContacts
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getById(int $id): Contacts
    {
        $contacts = $this->entityManager->getRepository(Contacts::class)->find($id);
        if (! $contacts instanceof Contacts) {
            throw ContactsNotFound::byId();
        }
        return $contacts;
    }

    public function getByUser(int $userId): ?array
    {
        return $this->entityManager->getRepository(Contacts::class)->findBy(
            [
                'user' => $userId,
            ]
        );
    }
}
