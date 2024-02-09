<?php
namespace Agenda\Contacts\Application\DI;

use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Contacts\Domain\ReadModel\GetContacts;
use Agenda\Contacts\Domain\Service\GetContactsService;
use Agenda\Contacts\Infrastructure\ReadModel\DoctrineOrm\GetContactsFromDoctrineOrm;
use Agenda\Core\Infrastructure\Db\DoctrineConfiguration;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

class ContactsInjector
{
    
    public static function inject(App $app): Container
    {
        $container = $app->getContainer();

        $container[GetContactsService::class] = function (ContainerInterface $container)
        {
            return new GetContactsService(
                $container->get(GetUsers::class),
                $container->get(GetContacts::class),
                $container->get(Jwt::class)
            );
        };

        $container[GetContacts::class] = function (ContainerInterface $container)
        {
            return new GetContactsFromDoctrineOrm(
                $container->get(DoctrineConfiguration::class)
            );
        };
        
        return $container;
    }
}