<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Dto;

use Assert\Assert;

class GetContatcDto
{
    private int $id;

    public function __construct()
    {
    }

    public static function fromArray(array $params): self
    {
        $instance = new self();
        Assert::thatNullOr($params['id'])
            ->notEmpty('o id não pode estar vazio.')
            ->integerish('o id tem que ser inteiro.');

        $instance->id = (int) $params['id'];

        return $instance;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
