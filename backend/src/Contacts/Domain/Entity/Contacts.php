<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Entity;

use Agenda\Auth\Domain\Entity\Users;
use Agenda\Contacts\Domain\Dto\SaveContactsDto;
use Agenda\Contacts\Domain\Dto\SavePhoneDto;
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

    #[OneToMany(targetEntity: Phone::class, mappedBy: 'contact', cascade: ['persist', 'remove'])]
    private Collection $phones;

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
            'user'    => $this->user,
        ];
    }

    public static function setFromDto(
        SaveContactsDto $saveContactsDto,
        Users $users
    ): self {
        $entity          = new self();
        $entity->name    = $saveContactsDto->getName();
        $entity->email   = $saveContactsDto->getEmail();
        $entity->address = $saveContactsDto->getAddress();
        $entity->user    = $users;

        $phonesCollection = new ArrayCollection();
        $phonesCollection->clear();
        array_map(function (SavePhoneDto $phone) use ($phonesCollection) {
            $phonesCollection->add(Phone::setCollectionContacts($phone));
        }, $saveContactsDto->getPhones());
        return $entity;
    }
}
