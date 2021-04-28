<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426130419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6348F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_497DD6348F5EA509 ON categorie (classe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6348F5EA509');
        $this->addSql('DROP INDEX IDX_497DD6348F5EA509 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP classe_id');
    }
}
