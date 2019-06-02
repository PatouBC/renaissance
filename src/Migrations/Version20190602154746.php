<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602154746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE timeslot (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, typeconsult_id INT DEFAULT NULL, slot INT NOT NULL, dispo TINYINT(1) NOT NULL, confirmed TINYINT(1) NOT NULL, INDEX IDX_3BE452F7A76ED395 (user_id), INDEX IDX_3BE452F7C14B2C95 (typeconsult_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE timeslot ADD CONSTRAINT FK_3BE452F7A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE timeslot ADD CONSTRAINT FK_3BE452F7C14B2C95 FOREIGN KEY (typeconsult_id) REFERENCES typeconsult (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE timeslot');
    }
}
