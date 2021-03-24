<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324152833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE local ADD adresse VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) NOT NULL, ADD co VARCHAR(10) DEFAULT NULL, ADD compteur_edf VARCHAR(255) DEFAULT NULL, ADD internet VARCHAR(255) DEFAULT NULL, ADD eau VARCHAR(255) DEFAULT NULL, ADD gaz VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE local DROP adresse, DROP ville, DROP co, DROP compteur_edf, DROP internet, DROP eau, DROP gaz');
    }
}
