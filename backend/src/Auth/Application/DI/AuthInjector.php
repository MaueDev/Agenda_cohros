<?php

declare(strict_types=1);

namespace Agenda\Auth\Application\DI;

use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Domain\Services\AuthenticationService;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Auth\Infrastructure\ReadModel\DoctrineOrm\GetUsersFromDoctrineOrm;
use Agenda\Core\Infrastructure\Db\DoctrineConfiguration;
use Psr\Container\ContainerInterface;
use Slim\App;

class AuthInjector
{
    public static function inject(App $app): ContainerInterface
    {
        $container = $app->getContainer();

        $container[GetUsers::class] = function (ContainerInterface $container) {
            return new GetUsersFromDoctrineOrm(
                $container->get(DoctrineConfiguration::class)
            );
        };

        $container[AuthenticationService::class] = function (ContainerInterface $container) {
            return new AuthenticationService(
                $container->get(GetUsers::class),
                $container->get(Jwt::class)
            );
        };

        $container[Jwt::class] = function (ContainerInterface $container) {
            return new Jwt();
        };

        return $container;
    }
}
