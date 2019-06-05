<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605093911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE daypart ADD workingday_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE daypart ADD CONSTRAINT FK_BDB44613DECCCC0A FOREIGN KEY (workingday_id) REFERENCES workingday (id)');
        $this->addSql('CREATE INDEX IDX_BDB44613DECCCC0A ON daypart (workingday_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE daypart DROP FOREIGN KEY FK_BDB44613DECCCC0A');
        $this->addSql('DROP INDEX IDX_BDB44613DECCCC0A ON daypart');
        $this->addSql('ALTER TABLE daypart DROP workingday_id');
    }
}
