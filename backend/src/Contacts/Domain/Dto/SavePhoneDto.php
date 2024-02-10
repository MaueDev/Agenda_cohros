<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\SavePhoneEnum;
use Agenda\Contacts\Domain\Traits\PhoneHelper;
use Assert\Assert;

class SavePhoneDto
{
    use PhoneHelper;

    private string $number;
    public static function fromString(string $number): self
    {
        $instance = new self();
        Assert::thatNullOr($number)
            ->string(SavePhoneEnum::STRING_PHONE->value);

        $instance->number = (string) PhoneHelper::unformatPhone($number);
        return $instance;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
