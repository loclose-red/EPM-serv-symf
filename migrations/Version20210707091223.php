<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707091223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_site (utilisateur_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_A0C265DEFB88E14F (utilisateur_id), INDEX IDX_A0C265DEF6BD1646 (site_id), PRIMARY KEY(utilisateur_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_site ADD CONSTRAINT FK_A0C265DEFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_site ADD CONSTRAINT FK_A0C265DEF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE capteur ADD site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE capteur ADD CONSTRAINT FK_5B4A1695F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_5B4A1695F6BD1646 ON capteur (site_id)');
        $this->addSql('ALTER TABLE equipement ADD site_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_B8B4C6F3F6BD1646 ON equipement (site_id)');
        $this->addSql('ALTER TABLE pt_mesure ADD equipement_id INT NOT NULL');
        $this->addSql('ALTER TABLE pt_mesure ADD CONSTRAINT FK_5F41E9C806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('CREATE INDEX IDX_5F41E9C806F0F5C ON pt_mesure (equipement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateur_site');
        $this->addSql('ALTER TABLE capteur DROP FOREIGN KEY FK_5B4A1695F6BD1646');
        $this->addSql('DROP INDEX IDX_5B4A1695F6BD1646 ON capteur');
        $this->addSql('ALTER TABLE capteur DROP site_id');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3F6BD1646');
        $this->addSql('DROP INDEX IDX_B8B4C6F3F6BD1646 ON equipement');
        $this->addSql('ALTER TABLE equipement DROP site_id');
        $this->addSql('ALTER TABLE pt_mesure DROP FOREIGN KEY FK_5F41E9C806F0F5C');
        $this->addSql('DROP INDEX IDX_5F41E9C806F0F5C ON pt_mesure');
        $this->addSql('ALTER TABLE pt_mesure DROP equipement_id');
    }
}
