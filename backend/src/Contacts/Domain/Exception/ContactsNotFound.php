<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Exception;

use DomainException;

class ContactsNotFound extends DomainException
{
    public static function byId(): self
    {
        return new self(
            sprintf('Contato não encontrado')
        );
    }
}
