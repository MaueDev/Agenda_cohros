<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use Assert\Assert;

class GetContactsDto
{
    private string $header;
    public function __construct()
    {
    }

    public static function fromHeader(string $header): self
    {
        $instance = new self();
        $token    = str_replace('Bearer ', '', $header);
        Assert::thatNullOr($header)
            ->notEmpty(ContactsEnum::EMPTY_AUTH_HEADER->value);
        Assert::thatNullOr($token)
            ->notEmpty(ContactsEnum::EMPTY_AUTH_HEADER->value);

        $instance->header = $header;

        return $instance;
    }

    public function getHeader(): string
    {
        return $this->header;
    }
}
