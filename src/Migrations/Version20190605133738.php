<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605133738 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE day_part ADD status_id INT NOT NULL, ADD type_id INT NOT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE day_part ADD CONSTRAINT FK_E2679DB06BF700BD FOREIGN KEY (status_id) REFERENCES day_part_status (id)');
        $this->addSql('ALTER TABLE day_part ADD CONSTRAINT FK_E2679DB0C54C8C93 FOREIGN KEY (type_id) REFERENCES day_part_type (id)');
        $this->addSql('ALTER TABLE day_part ADD CONSTRAINT FK_E2679DB0A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_E2679DB06BF700BD ON day_part (status_id)');
        $this->addSql('CREATE INDEX IDX_E2679DB0C54C8C93 ON day_part (type_id)');
        $this->addSql('CREATE INDEX IDX_E2679DB0A76ED395 ON day_part (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE status');
        $this->addSql('ALTER TABLE day_part DROP FOREIGN KEY FK_E2679DB06BF700BD');
        $this->addSql('ALTER TABLE day_part DROP FOREIGN KEY FK_E2679DB0C54C8C93');
        $this->addSql('ALTER TABLE day_part DROP FOREIGN KEY FK_E2679DB0A76ED395');
        $this->addSql('DROP INDEX IDX_E2679DB06BF700BD ON day_part');
        $this->addSql('DROP INDEX IDX_E2679DB0C54C8C93 ON day_part');
        $this->addSql('DROP INDEX IDX_E2679DB0A76ED395 ON day_part');
        $this->addSql('ALTER TABLE day_part DROP status_id, DROP type_id, DROP user_id');
    }
}
