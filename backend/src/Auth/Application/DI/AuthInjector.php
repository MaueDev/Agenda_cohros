<?php
namespace Agenda\Auth\Application\DI;

use Agenda\Auth\Domain\Services\AuthenticationService;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

class AuthInjector
{
    
    public static function inject(App $app): Container
    {
        $container = $app->getContainer();

        $container[AuthenticationService::class] = function (ContainerInterface $container) {
            return new AuthenticationService();
        };

        return $container;
    }
}