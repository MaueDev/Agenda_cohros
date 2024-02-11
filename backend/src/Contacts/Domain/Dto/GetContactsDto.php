<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

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
            ->notEmpty('Cabeçalho de autorização não pode estar vazio.');
        Assert::thatNullOr($token)
            ->notEmpty('Cabeçalho de autorização não pode estar vazio.');

        $instance->header = $header;

        return $instance;
    }

    public function getHeader(): string
    {
        return $this->header;
    }
}
