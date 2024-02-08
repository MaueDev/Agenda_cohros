<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Exception;

use DomainException;

class UserNotFound extends DomainException
{
    public static function ByUsernameAndPassword(): self
    {
        return new self(
            sprintf('Usuario ou senha não encontrado')
        );
    }
}
