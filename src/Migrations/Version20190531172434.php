<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190531172434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE timeslot ADD typeconsult_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE timeslot ADD CONSTRAINT FK_3BE452F7C14B2C95 FOREIGN KEY (typeconsult_id) REFERENCES typeconsult (id)');
        $this->addSql('CREATE INDEX IDX_3BE452F7C14B2C95 ON timeslot (typeconsult_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE timeslot DROP FOREIGN KEY FK_3BE452F7C14B2C95');
        $this->addSql('DROP INDEX IDX_3BE452F7C14B2C95 ON timeslot');
        $this->addSql('ALTER TABLE timeslot DROP typeconsult_id');
    }
}
