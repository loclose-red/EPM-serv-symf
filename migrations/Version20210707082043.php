<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707082043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE capteur ADD grandeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE capteur ADD CONSTRAINT FK_5B4A16952069AD09 FOREIGN KEY (grandeur_id) REFERENCES grandeur (id)');
        $this->addSql('CREATE INDEX IDX_5B4A16952069AD09 ON capteur (grandeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE capteur DROP FOREIGN KEY FK_5B4A16952069AD09');
        $this->addSql('DROP INDEX IDX_5B4A16952069AD09 ON capteur');
        $this->addSql('ALTER TABLE capteur DROP grandeur_id');
    }
}
