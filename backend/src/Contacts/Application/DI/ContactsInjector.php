<?php

declare(strict_types=1);

namespace Agenda\Contacts\Application\DI;

use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Domain\ReadModel\GetContacts;
use Agenda\Contacts\Domain\Repository\SaveContactsRepository;
use Agenda\Contacts\Domain\Service\GetContactsService;
use Agenda\Contacts\Domain\Service\SaveContactsService;
use Agenda\Contacts\Infrastructure\Persistence\DoctrineOrm\SaveContactsRepositoryFromDoctrineOrm;
use Agenda\Contacts\Infrastructure\ReadModel\DoctrineOrm\GetContactsFromDoctrineOrm;
use Agenda\Core\Infrastructure\Db\DoctrineConfiguration;
use Psr\Container\ContainerInterface;
use Slim\App;

class ContactsInjector
{
    public static function inject(App $app): ContainerInterface
    {
        $container = $app->getContainer();

        $container[GetContactsService::class] = function (ContainerInterface $container) {
            return new GetContactsService(
                $container->get(GetUsers::class),
                $container->get(GetContacts::class),
                $container->get(Jwt::class)
            );
        };

        $container[SaveContactsService::class] = function (ContainerInterface $container) {
            return new SaveContactsService(
                $container->get(SaveContactsRepository::class),
                $container->get(GetUsers::class),
                $container->get(Jwt::class)
            );
        };

        $container[GetContacts::class] = function (ContainerInterface $container) {
            return new GetContactsFromDoctrineOrm(
                $container->get(DoctrineConfiguration::class)
            );
        };

        $container[SaveContactsRepository::class] = function (ContainerInterface $container) {
            return new SaveContactsRepositoryFromDoctrineOrm(
                $container->get(DoctrineConfiguration::class)
            );
        };

        return $container;
    }
}
