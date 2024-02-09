<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Exception;

use DomainException;

class UserNotFound extends DomainException
{
    public static function byUsernameAndPassword(): self
    {
        return new self(
            sprintf('Usuario ou senha não encontrado')
        );
    }

    public static function byNameAndEmail(): self
    {
        return new self(
            sprintf('Nome e e-mail não encontrado')
        );
    }
}
