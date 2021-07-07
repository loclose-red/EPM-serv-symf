<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707085004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mesure ADD capteur_id INT NOT NULL, ADD ptmesure_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesure ADD CONSTRAINT FK_5F1B6E701708A229 FOREIGN KEY (capteur_id) REFERENCES capteur (id)');
        $this->addSql('ALTER TABLE mesure ADD CONSTRAINT FK_5F1B6E70CFA5F0A9 FOREIGN KEY (ptmesure_id) REFERENCES pt_mesure (id)');
        $this->addSql('CREATE INDEX IDX_5F1B6E701708A229 ON mesure (capteur_id)');
        $this->addSql('CREATE INDEX IDX_5F1B6E70CFA5F0A9 ON mesure (ptmesure_id)');
        $this->addSql('ALTER TABLE pt_mesure ADD grandeur_id INT NOT NULL, ADD capteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pt_mesure ADD CONSTRAINT FK_5F41E9C2069AD09 FOREIGN KEY (grandeur_id) REFERENCES grandeur (id)');
        $this->addSql('ALTER TABLE pt_mesure ADD CONSTRAINT FK_5F41E9C1708A229 FOREIGN KEY (capteur_id) REFERENCES capteur (id)');
        $this->addSql('CREATE INDEX IDX_5F41E9C2069AD09 ON pt_mesure (grandeur_id)');
        $this->addSql('CREATE INDEX IDX_5F41E9C1708A229 ON pt_mesure (capteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mesure DROP FOREIGN KEY FK_5F1B6E701708A229');
        $this->addSql('ALTER TABLE mesure DROP FOREIGN KEY FK_5F1B6E70CFA5F0A9');
        $this->addSql('DROP INDEX IDX_5F1B6E701708A229 ON mesure');
        $this->addSql('DROP INDEX IDX_5F1B6E70CFA5F0A9 ON mesure');
        $this->addSql('ALTER TABLE mesure DROP capteur_id, DROP ptmesure_id');
        $this->addSql('ALTER TABLE pt_mesure DROP FOREIGN KEY FK_5F41E9C2069AD09');
        $this->addSql('ALTER TABLE pt_mesure DROP FOREIGN KEY FK_5F41E9C1708A229');
        $this->addSql('DROP INDEX IDX_5F41E9C2069AD09 ON pt_mesure');
        $this->addSql('DROP INDEX IDX_5F41E9C1708A229 ON pt_mesure');
        $this->addSql('ALTER TABLE pt_mesure DROP grandeur_id, DROP capteur_id');
    }
}
