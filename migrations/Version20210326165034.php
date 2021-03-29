<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326165034 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE loyer (id INT AUTO_INCREMENT NOT NULL, contrat_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, montant_tot DOUBLE PRECISION NOT NULL, loyer DOUBLE PRECISION NOT NULL, charge DOUBLE PRECISION NOT NULL, caf DOUBLE PRECISION DEFAULT NULL, status TINYINT(1) NOT NULL, periode_du DATE NOT NULL, periode_au DATE NOT NULL, paiement DOUBLE PRECISION DEFAULT NULL, charges_info VARCHAR(255) DEFAULT NULL, paie_1 DOUBLE PRECISION DEFAULT NULL, paie_2 DOUBLE PRECISION DEFAULT NULL, INDEX IDX_40456291823061F (contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE loyer ADD CONSTRAINT FK_40456291823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE contrat CHANGE actif actif TINYINT(1) DEFAULT \'1\'');
        $this->addSql('ALTER TABLE ecriture CHANGE pointage pointage INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE loyer');
        $this->addSql('ALTER TABLE contrat CHANGE actif actif TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE ecriture CHANGE pointage pointage TINYINT(1) DEFAULT NULL');
    }
}
