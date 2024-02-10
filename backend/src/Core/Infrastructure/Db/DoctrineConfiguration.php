<?php

declare(strict_types=1);

namespace Agenda\Core\Infrastructure\Db;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class DoctrineConfiguration
{
    public static function entityManager(): EntityManager
    {
        $paths     = [__DIR__ . '/../../../Auth/Domain/Entity'];
        $isDevMode = true;

        $ormConfig  = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection([
            'dbname'   => 'agenda',
            'user'     => 'root',
            'password' => 'root',
            'host'     => 'mysql',
            'driver'   => 'pdo_mysql',
        ]);

        return new EntityManager($connection, $ormConfig);
    }
}
