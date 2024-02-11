<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Dto;

use Agenda\Auth\Domain\Enum\Dto\AuthEnum;
use Assert\Assert;

class VerifyAuthenticateDto
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
            ->notEmpty(AuthEnum::EMPTY_HEADER->value);
        Assert::thatNullOr($token)
            ->notEmpty(AuthEnum::EMPTY_HEADER->value);

        $instance->header = $header;

        return $instance;
    }

    public function getHeader(): string
    {
        return $this->header;
    }
}
