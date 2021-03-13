<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312094135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ecriture (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, date DATE DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, pointage INT DEFAULT NULL, INDEX IDX_3098DEB5D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE local (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ecriture ADD CONSTRAINT FK_3098DEB5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecriture DROP FOREIGN KEY FK_3098DEB5D5A2101');
        $this->addSql('DROP TABLE ecriture');
        $this->addSql('DROP TABLE local');
    }
}
