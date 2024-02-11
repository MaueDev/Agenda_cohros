<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Enum\Dto;

enum PhoneEnum: string
{
    case STRING_PHONE = 'O telefone deve ser uma string.';
}
