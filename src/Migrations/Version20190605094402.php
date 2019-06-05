<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605094402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE daypart ADD status_id INT NOT NULL, ADD type_id INT NOT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE daypart ADD CONSTRAINT FK_BDB446136BF700BD FOREIGN KEY (status_id) REFERENCES daypartstatus (id)');
        $this->addSql('ALTER TABLE daypart ADD CONSTRAINT FK_BDB44613C54C8C93 FOREIGN KEY (type_id) REFERENCES dayparttype (id)');
        $this->addSql('ALTER TABLE daypart ADD CONSTRAINT FK_BDB44613A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_BDB446136BF700BD ON daypart (status_id)');
        $this->addSql('CREATE INDEX IDX_BDB44613C54C8C93 ON daypart (type_id)');
        $this->addSql('CREATE INDEX IDX_BDB44613A76ED395 ON daypart (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE daypart DROP FOREIGN KEY FK_BDB446136BF700BD');
        $this->addSql('ALTER TABLE daypart DROP FOREIGN KEY FK_BDB44613C54C8C93');
        $this->addSql('ALTER TABLE daypart DROP FOREIGN KEY FK_BDB44613A76ED395');
        $this->addSql('DROP INDEX IDX_BDB446136BF700BD ON daypart');
        $this->addSql('DROP INDEX IDX_BDB44613C54C8C93 ON daypart');
        $this->addSql('DROP INDEX IDX_BDB44613A76ED395 ON daypart');
        $this->addSql('ALTER TABLE daypart DROP status_id, DROP type_id, DROP user_id');
    }
}
