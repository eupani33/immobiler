<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409035644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE charge ADD local_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE charge ADD CONSTRAINT FK_556BA4345D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('CREATE INDEX IDX_556BA4345D5A2101 ON charge (local_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE charge DROP FOREIGN KEY FK_556BA4345D5A2101');
        $this->addSql('DROP INDEX IDX_556BA4345D5A2101 ON charge');
        $this->addSql('ALTER TABLE charge DROP local_id');
    }
}
