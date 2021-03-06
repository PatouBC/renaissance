<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190526171534 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rendezvous ADD timeslot_id INT DEFAULT NULL, ADD typeconsult_id INT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8F920B9E9 FOREIGN KEY (timeslot_id) REFERENCES timeslot (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8C14B2C95 FOREIGN KEY (typeconsult_id) REFERENCES typeconsult (id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8F920B9E9 ON rendezvous (timeslot_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8C14B2C95 ON rendezvous (typeconsult_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8F920B9E9');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8C14B2C95');
        $this->addSql('DROP INDEX IDX_C09A9BA8F920B9E9 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA8C14B2C95 ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous DROP timeslot_id, DROP typeconsult_id');
    }
}
