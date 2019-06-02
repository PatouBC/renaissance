<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602155147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE timeslot ADD workingday_id INT NOT NULL');
        $this->addSql('ALTER TABLE timeslot ADD CONSTRAINT FK_3BE452F7DECCCC0A FOREIGN KEY (workingday_id) REFERENCES workingday (id)');
        $this->addSql('CREATE INDEX IDX_3BE452F7DECCCC0A ON timeslot (workingday_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE timeslot DROP FOREIGN KEY FK_3BE452F7DECCCC0A');
        $this->addSql('DROP INDEX IDX_3BE452F7DECCCC0A ON timeslot');
        $this->addSql('ALTER TABLE timeslot DROP workingday_id');
    }
}
