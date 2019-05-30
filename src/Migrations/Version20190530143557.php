<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190530143557 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE workingday (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workingday_timeslot (workingday_id INT NOT NULL, timeslot_id INT NOT NULL, INDEX IDX_69AB9063DECCCC0A (workingday_id), INDEX IDX_69AB9063F920B9E9 (timeslot_id), PRIMARY KEY(workingday_id, timeslot_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workingday_timeslot ADD CONSTRAINT FK_69AB9063DECCCC0A FOREIGN KEY (workingday_id) REFERENCES workingday (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workingday_timeslot ADD CONSTRAINT FK_69AB9063F920B9E9 FOREIGN KEY (timeslot_id) REFERENCES timeslot (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE workingday_timeslot DROP FOREIGN KEY FK_69AB9063DECCCC0A');
        $this->addSql('DROP TABLE workingday');
        $this->addSql('DROP TABLE workingday_timeslot');
    }
}
