<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Enum\Dto;

enum SaveContactsEnum: string
{
    case EMPTY_NAME  = 'O nome não pode estar vazio.';
    case STRING_NAME = 'O nome deve ser uma string.';

    case EMPTY_EMAIL  = 'O email não pode estar vazio.';
    case STRING_EMAIL = 'O email deve ser uma string válida.';

    case EMPTY_ADDRESS  = 'O endereço não pode estar vazio.';
    case STRING_ADDRESS = 'O endereço deve ser uma string.';

    case EMPTY_PHONES = 'A lista de telefones não pode estar vazia.';
    case ARRAY_PHONES = 'A lista de telefones deve ser um array.';

    case EMPTY_AUTH_HEADER  = 'O cabeçalho de autorização não pode estar vazio.';
    case STRING_AUTH_HEADER = 'O cabeçalho de autorização deve ser uma string.';
}
