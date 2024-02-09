<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Dto;

use Agenda\Auth\Domain\Enum\Dto\AuthLoginEnum;
use Assert\Assert;
class AuthenticationDto{
    private string $username;
    private string $password;
    public function __construct()
    {
    }

    public static function fromArray(array $params): self
    {
        $instance = new self();
        Assert::thatNullOr($params['username'])
            ->notEmpty(AuthLoginEnum::EMPTY_USERNAME->value)
            ->string(AuthLoginEnum::EMPTY_USERNAME->value);
        Assert::thatNullOr($params['password'])
            ->notEmpty(AuthLoginEnum::EMPTY_PASSWORD->value)
            ->string(AuthLoginEnum::STRING_PASSWORD->value);
            
        

        $instance->username = $params['username'];
        $instance->password = $params['password'];

        return $instance;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function getUsername(): string{
        return $this->username;
    }
}