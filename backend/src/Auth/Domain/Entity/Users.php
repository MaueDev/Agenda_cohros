<?php

declare(strict_types=1);

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
    private string $name;

    #[Column(type: "string", length: 32, unique: true, nullable: false)]
    private string $email;

    #[Column(type: "string", length: 32, nullable: false)]
    private string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPublicValue(): array
    {
        return [
            'name'  => $this->getName(),
            'email' => $this->getEmail(),
        ];
    }
}
