<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\PhoneEnum;
use Assert\Assert;

class PhoneDto
{
    private ?string $number;
    public static function fromString(?string $number): self
    {
        $instance = new self();
        Assert::thatNullOr($number)
            ->string(PhoneEnum::STRING_PHONE->value);

        $instance->number = $number;
        return $instance;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }
}
