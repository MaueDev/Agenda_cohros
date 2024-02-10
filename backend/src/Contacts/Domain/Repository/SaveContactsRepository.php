<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Repository;

use Agenda\Contacts\Domain\Entity\Contacts;

interface SaveContactsRepository
{
    public function store(Contacts $contacts): void;

    public function remove(Contacts $contacts): void;
}
