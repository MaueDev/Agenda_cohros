<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Entity;

use Agenda\Auth\Domain\Entity\Users;
use Agenda\Contacts\Domain\Dto\PhoneDto;
use Agenda\Contacts\Domain\Dto\SaveContactsDto;
use Agenda\Contacts\Domain\Dto\UpdateContactDto;
use Agenda\Contacts\Domain\Traits\PhoneHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'contacts')]
class Contacts
{
    use PhoneHelper;

    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $name;

    #[Column(type: 'string', length: 255)]
    private string $email;

    #[Column(type: 'string', length: 255)]
    private string $address;

    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private Users $user;

    #[OneToMany(targetEntity: Phone::class, mappedBy: 'contacts', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $phones;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setUser(Users $user): void
    {
        $this->user = $user;
    }

    public function setPhones(Collection $phones): void
    {
        $this->phones = $phones;
    }

    public function getAllValues(): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'address' => $this->address,
            'phones'
            => array_map(function (Phone $phone) {
                return $phone->getFormattedNumber();
            }, $this->phones->toArray()),
        ];
    }

    public static function setFromDto(
        SaveContactsDto $updateContactDto,
        Users $users
    ): self {
        $entity          = new self();
        $entity->name    = $updateContactDto->getName();
        $entity->email   = $updateContactDto->getEmail();
        $entity->address = $updateContactDto->getAddress();
        $entity->user    = $users;

        $entity->phones = new ArrayCollection();
        $entity->phones->clear();
        array_map(function (PhoneDto $phone) use ($entity) {
            $entity->phones->add(Phone::setCollectionContacts($phone, $entity));
        }, $updateContactDto->getPhones());

        return $entity;
    }

    public function setUpdateFromDto(
        UpdateContactDto $updateContactDto
    ): void {
        $this->name    = $updateContactDto->getName();
        $this->email   = $updateContactDto->getEmail();
        $this->address = $updateContactDto->getAddress();
        $this->phones->clear();
        array_map(function (PhoneDto $phone) {
            $this->phones->add(Phone::setCollectionContacts($phone, $this));
        }, $updateContactDto->getPhones());
    }
}
