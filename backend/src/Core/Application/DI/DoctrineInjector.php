<?php
namespace Agenda\Core\Application\DI;

use Agenda\Core\Infrastructure\Db\DoctrineConfiguration;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

class DoctrineInjector
{
    
    public static function inject(App $app): Container
    {
        $container = $app->getContainer();

        $container[DoctrineConfiguration::class] = function (ContainerInterface $container) {
            return DoctrineConfiguration::EntityManager();
        };

        return $container;
    }
}