<?php

declare(strict_types=1);

namespace Agenda\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208020520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add username and email columns to users table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('users');
        $table->addColumn('name', 'string', [
            'length' => 32,
            'notnull' => true,
        ]);
        $table->addColumn('email', 'string', [
            'length' => 32,
            'notnull' => true,
        ]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('users');
        $table->dropColumn('name');
        $table->dropColumn('email');
    }
}
