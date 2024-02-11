<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\PhoneEnum;
use Agenda\Contacts\Domain\Traits\PhoneHelper;
use Assert\Assert;

class PhoneDto
{
    use PhoneHelper;

    private ?string $number;
    public static function fromString(?string $number): self
    {
        $instance = new self();
        Assert::thatNullOr($number)
            ->string(PhoneEnum::STRING_PHONE->value);

        $instance->number = PhoneHelper::unformatPhone($number);
        return $instance;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }
}
