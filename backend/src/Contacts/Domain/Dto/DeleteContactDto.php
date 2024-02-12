<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use Assert\Assert;

class DeleteContactDto
{
    private int $id;

    public function __construct()
    {
    }

    public static function fromArray(array $params): self
    {
        $instance = new self();
        Assert::thatNullOr($params['id'])
            ->notEmpty(ContactsEnum::EMPTY_ID->value)
            ->integerish(ContactsEnum::INTEGER_ID->value);

        $instance->id = (int) $params['id'];

        return $instance;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
