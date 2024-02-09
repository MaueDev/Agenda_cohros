<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\ReadModel;

use Agenda\Contacts\Domain\Entity\Contacts;

interface GetContacts{
    public function getById(int $id): Contacts;

    public function getByUser(int $userId): ?array;
}