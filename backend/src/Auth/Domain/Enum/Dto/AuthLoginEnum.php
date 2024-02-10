<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Enum\Dto;

enum AuthLoginEnum: string
{
    case EMPTY_USERNAME  = 'O campo "username" não pode estar vazio.';
    case STRING_USERNAME = 'O campo "username" precisa ser uma string.';
    case EMPTY_PASSWORD  = 'O campo "password" não pode estar vazio.';
    case STRING_PASSWORD = 'O campo "password" precisa ser uma string.';
}
