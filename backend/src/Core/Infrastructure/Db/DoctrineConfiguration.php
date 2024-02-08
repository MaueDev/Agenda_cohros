<?php

namespace Agenda\Core\Infrastructure\Db;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

class DoctrineConfiguration
{
    public static function EntityManager(): EntityManager
    {
        $paths = [__DIR__.'/../../../Auth/Domain/Entity'];
        $isDevMode = true;

        $ORMConfig = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection([
            'dbname' => 'agenda',
            'user' => 'root',
            'password' => 'root',
            'host' => 'mysql',
            'driver' => 'pdo_mysql',
        ]);

        $entityManager = new EntityManager($connection, $ORMConfig);
        return $entityManager;
    }
}
