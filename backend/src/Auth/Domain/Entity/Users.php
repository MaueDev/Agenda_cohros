<?php

namespace Agenda\Auth\Domain\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'users')]
class Users
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    
    private int $id;

    #[Column(type: "string", length: 32, unique: true, nullable: false)]
    private string $username;

    #[Column(type: "string", length: 32, nullable: false)]
    private string $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
}