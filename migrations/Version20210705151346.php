<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705151346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE capteur (id INT AUTO_INCREMENT NOT NULL, cap_marque VARCHAR(100) NOT NULL, cap_modele VARCHAR(100) NOT NULL, cap_serie VARCHAR(100) NOT NULL, cap_information VARCHAR(255) DEFAULT NULL, cap_archive TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, equ_marque VARCHAR(100) NOT NULL, equ_modele VARCHAR(100) NOT NULL, equ_serie VARCHAR(100) NOT NULL, equ_nom VARCHAR(45) DEFAULT NULL, equ_description VARCHAR(255) DEFAULT NULL, equ_photo_1 VARCHAR(100) DEFAULT NULL, equ_archive TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grandeur (id INT AUTO_INCREMENT NOT NULL, gra_unite VARCHAR(20) NOT NULL, gra_nom VARCHAR(45) NOT NULL, gra_archive TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesure (id INT AUTO_INCREMENT NOT NULL, mes_valeur_1 NUMERIC(10, 2) NOT NULL, mes_valeur_2 NUMERIC(10, 2) DEFAULT NULL, mes_valeur_3 NUMERIC(10, 2) DEFAULT NULL, mes_valeur_4 NUMERIC(10, 2) DEFAULT NULL, mes_date DATETIME NOT NULL, mes_archive TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pt_mesure (id INT AUTO_INCREMENT NOT NULL, pt_mes_nom VARCHAR(100) NOT NULL, pt_mes_position VARCHAR(100) DEFAULT NULL, pt_mes_archive TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, sit_raison_sociale VARCHAR(100) NOT NULL, sit_ville VARCHAR(120) NOT NULL, sit_c_postal VARCHAR(10) NOT NULL, sit_adresse VARCHAR(255) DEFAULT NULL, sit_information VARCHAR(255) DEFAULT NULL, sit_archive TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE capteur');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE grandeur');
        $this->addSql('DROP TABLE mesure');
        $this->addSql('DROP TABLE pt_mesure');
        $this->addSql('DROP TABLE site');
    }
}
