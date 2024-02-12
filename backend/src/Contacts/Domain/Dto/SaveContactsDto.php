<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use Assert\Assert;

class SaveContactsDto
{
    private string $name;
    private string $email;
    private string $address;
    private array $phones;
    private string $authorizationHeader;
    public function __construct()
    {
    }

    public static function fromArray(array $params): self
    {
        $instance = new self();
        Assert::that($params['authorizationHeader'])
            ->notEmpty(ContactsEnum::EMPTY_AUTH_HEADER->value)
            ->string(ContactsEnum::STRING_AUTH_HEADER->value);

        Assert::thatNullOr($params['email'])
            ->notEmpty(ContactsEnum::EMPTY_EMAIL->value)
            ->email(ContactsEnum::INVALID_EMAIL->value)
            ->string(ContactsEnum::STRING_EMAIL->value);

        Assert::thatNullOr($params['address'])
            ->notEmpty(ContactsEnum::EMPTY_ADDRESS->value)
            ->string(ContactsEnum::STRING_ADDRESS->value);

        Assert::thatNullOr($params['phones'])
            ->isArray(ContactsEnum::ARRAY_PHONES->value);

        $instance->phones              = array_map(function (string $phone) {
            return PhoneDto::fromString($phone);
        }, $params['phones']);
        $instance->name                = $params['name'];
        $instance->email               = $params['email'];
        $instance->address             = $params['address'];
        $instance->authorizationHeader = $params['authorizationHeader'];

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

    public function getAuthorizationHeader(): string
    {
        return $this->authorizationHeader;
    }
}
