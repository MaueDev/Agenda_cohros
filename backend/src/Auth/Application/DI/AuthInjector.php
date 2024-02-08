<?php
namespace Agenda\Auth\Application\DI;

use Agenda\Auth\Domain\Services\AuthenticationService;
use Agenda\Auth\Infrastructure\ReadModel\DoctrineOrm\GetUsersFromDoctrineOrm;
use Agenda\Core\Infrastructure\Db\DoctrineConfiguration;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

class AuthInjector
{
    
    public static function inject(App $app): Container
    {
        $container = $app->getContainer();

        $container[GetUsersFromDoctrineOrm::class] = function (ContainerInterface $container)
        {
            return new GetUsersFromDoctrineOrm(
                $container->get(DoctrineConfiguration::class)
            );
        };
        
        $container[AuthenticationService::class] = function (ContainerInterface $container) {
            return new AuthenticationService(
                $container->get(GetUsersFromDoctrineOrm::class)
            );
        };

        
        return $container;
    }
}