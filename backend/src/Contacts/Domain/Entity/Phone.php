<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Entity;

use Agenda\Contacts\Domain\Dto\SavePhoneDto;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'phones')]
class Phone
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private int $id;

    #[Column(type: 'string', length: 20)]
    private string $number;

    #[ManyToOne(targetEntity: Contacts::class, inversedBy: 'phones')]
    #[JoinColumn(name: 'contact_id', referencedColumnName: 'id')]
    private Contacts $contacts;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function setContacts(Contacts $contacts): void
    {
        $this->contacts = $contacts;
    }

    public static function setCollectionContacts(SavePhoneDto $phoneDto): self
    {
        $entity         = new self();
        $entity->number = $phoneDto->getNumber();
        return $entity;
    }
}
