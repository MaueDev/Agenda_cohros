<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use Assert\Assert;

class UpdateContactDto
{
    private int $id;
    private string $name;
    private string $email;
    private string $address;
    private array $phones;
    public function __construct()
    {
    }

    public static function fromArray(array $params): self
    {
        $instance = new self();
        Assert::thatNullOr($params['id'])
            ->notEmpty(ContactsEnum::EMPTY_ID->value)
            ->integerish(ContactsEnum::INTERGER_ID->value);

        Assert::thatNullOr($params['email'])
            ->notEmpty(ContactsEnum::EMPTY_EMAIL->value)
            ->email()
            ->string(ContactsEnum::STRING_EMAIL->value);

        Assert::thatNullOr($params['address'])
            ->notEmpty(ContactsEnum::EMPTY_ADDRESS->value)
            ->string(ContactsEnum::STRING_ADDRESS->value);

        Assert::thatNullOr($params['phones'])
            ->isArray(ContactsEnum::ARRAY_PHONES->value);

        $instance->phones  = array_map(function (string $phone) {
            return PhoneDto::fromString($phone);
        }, $params['phones']);
        $instance->name    = (string) $params['name'];
        $instance->email   = (string) $params['email'];
        $instance->address = (string) $params['address'];
        $instance->id      = (int) $params['id'];

        return $instance;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhones(): array
    {
        return $this->phones;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
