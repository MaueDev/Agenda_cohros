<?php 

namespace Agenda\Auth\Infrastructure\ReadModel\DoctrineOrm;

use Agenda\Auth\Domain\Entity\Users;
use Agenda\Auth\Domain\Exception\UserNotFound;
use Agenda\Auth\Domain\ReadModel\GetUsers;
use Doctrine\ORM\EntityManager;

class GetUsersFromDoctrineOrm implements GetUsers{

    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function byUsernameAndPassword(string $username,string $password): Users{
        $user = $this->entityManager->getRepository(Users::class)->findOneBy(
            [
                'username' => $username,
                'password' => $password,
            ]
        );
        if (!$user instanceof Users) {
            throw UserNotFound::byUsernameAndPassword();
        }
        return $user;
    }

    public function getByNameAndEmail(string $name,string $email): Users{
        $user = $this->entityManager->getRepository(Users::class)->findOneBy(
            [
                'name' => $name,
                'email' => $email,
            ]
        );
        if (!$user instanceof Users) {
            throw UserNotFound::byNameAndEmail();
        }
        return $user;
    }

}