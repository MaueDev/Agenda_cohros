<?php

declare(strict_types=1);

namespace Agenda\Contacts\Application\DI;

use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Domain\ReadModel\GetContacts;
use Agenda\Contacts\Domain\Repository\ContactsRepository;
use Agenda\Contacts\Domain\Service\DeleteContactService;
use Agenda\Contacts\Domain\Service\GetContactsService;
use Agenda\Contacts\Domain\Service\SaveContactsService;
use Agenda\Contacts\Domain\Service\UpdateContactService;
use Agenda\Contacts\Infrastructure\Persistence\DoctrineOrm\ContactsRepositoryFromDoctrineOrm;
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
                $container->get(ContactsRepository::class),
                $container->get(GetUsers::class),
                $container->get(Jwt::class)
            );
        };

        $container[UpdateContactService::class] = function (ContainerInterface $container) {
            return new UpdateContactService(
                $container->get(ContactsRepository::class),
                $container->get(GetContacts::class)
            );
        };

        $container[DeleteContactService::class] = function (ContainerInterface $container) {
            return new DeleteContactService(
                $container->get(ContactsRepository::class),
                $container->get(GetContacts::class)
            );
        };

        $container[GetContacts::class] = function (ContainerInterface $container) {
            return new GetContactsFromDoctrineOrm(
                $container->get(DoctrineConfiguration::class)
            );
        };

        $container[ContactsRepository::class] = function (ContainerInterface $container) {
            return new ContactsRepositoryFromDoctrineOrm(
                $container->get(DoctrineConfiguration::class)
            );
        };

        return $container;
    }
}
