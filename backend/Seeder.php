<?php 

require __DIR__.'/vendor/autoload.php';

use Agenda\Core\Domain\Seeder\PopulateInitialSeeder;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\DBAL\DriverManager;

$config = new PhpFile('migrations.php'); 
$paths = [
    __DIR__.'/src/Auth/Domain/Entity/',
    __DIR__.'/src/Contacts/Domain/Entity/'
];
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

$loader = new Loader();
$loader->addFixture(new PopulateInitialSeeder());
$fixtures = $loader->getFixtures();


$executor = new ORMExecutor($entityManager, new ORMPurger());
$executor->execute($loader->getFixtures());

echo "Seeder executado com sucesso.\n";