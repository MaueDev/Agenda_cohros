<?php

declare(strict_types=1);

namespace Agenda\Core\Application\DI;

use Agenda\Core\Infrastructure\Db\DoctrineConfiguration;
use Psr\Container\ContainerInterface;
use Slim\App;

class DoctrineInjector
{
    public static function inject(App $app): ContainerInterface
    {
        $container = $app->getContainer();

        $container[DoctrineConfiguration::class] = function () {
            return DoctrineConfiguration::entityManager();
        };

        return $container;
    }
}
