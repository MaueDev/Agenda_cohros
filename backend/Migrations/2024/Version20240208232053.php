<?php

declare(strict_types=1);

namespace Agenda\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208232053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE phones (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(20) NOT NULL, contact_id INT DEFAULT NULL, INDEX IDX_E3282EF5E7A1254A (contact_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE phones ADD CONSTRAINT FK_E3282EF5E7A1254A FOREIGN KEY (contact_id) REFERENCES contacts (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phones DROP FOREIGN KEY FK_E3282EF5E7A1254A');
        $this->addSql('DROP TABLE phones');
    }
}
