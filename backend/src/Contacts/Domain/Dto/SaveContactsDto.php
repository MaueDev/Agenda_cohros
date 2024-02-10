<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Enum\Dto\SaveContactsEnum;
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
        $token    = str_replace('Bearer ', '', $params['authorizationHeader']);
        Assert::that($params['authorizationHeader'])
            ->notEmpty(SaveContactsEnum::EMPTY_AUTH_HEADER->value)
            ->string(SaveContactsEnum::STRING_AUTH_HEADER->value);
        Assert::that($token)
            ->notEmpty(SaveContactsEnum::EMPTY_AUTH_HEADER->value);

        Assert::thatNullOr($params['email'])
            ->notEmpty(SaveContactsEnum::EMPTY_EMAIL->value)
            ->email()
            ->string(SaveContactsEnum::STRING_EMAIL->value);

        Assert::thatNullOr($params['address'])
            ->notEmpty(SaveContactsEnum::EMPTY_ADDRESS->value)
            ->string(SaveContactsEnum::STRING_ADDRESS->value);

        Assert::thatNullOr($params['phones'])
            ->isArray(SaveContactsEnum::ARRAY_PHONES->value);

        $instance->phones              = array_map(function (string $phone) {
            return SavePhoneDto::fromString($phone);
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
