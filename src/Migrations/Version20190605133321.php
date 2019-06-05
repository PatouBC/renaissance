<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605133321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE day_part ADD working_day_id INT NOT NULL');
        $this->addSql('ALTER TABLE day_part ADD CONSTRAINT FK_E2679DB0C2FEC4CB FOREIGN KEY (working_day_id) REFERENCES working_day (id)');
        $this->addSql('CREATE INDEX IDX_E2679DB0C2FEC4CB ON day_part (working_day_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE day_part DROP FOREIGN KEY FK_E2679DB0C2FEC4CB');
        $this->addSql('DROP INDEX IDX_E2679DB0C2FEC4CB ON day_part');
        $this->addSql('ALTER TABLE day_part DROP working_day_id');
    }
}
