<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523141841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE cave_id_seq CASCADE');
        $this->addSql('CREATE TABLE utilisateur_vin (utilisateur_id INT NOT NULL, vin_id INT NOT NULL, PRIMARY KEY(utilisateur_id, vin_id))');
        $this->addSql('CREATE INDEX IDX_3C44ED32FB88E14F ON utilisateur_vin (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_3C44ED32BA62C651 ON utilisateur_vin (vin_id)');
        $this->addSql('ALTER TABLE utilisateur_vin ADD CONSTRAINT FK_3C44ED32FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_vin ADD CONSTRAINT FK_3C44ED32BA62C651 FOREIGN KEY (vin_id) REFERENCES vin (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cave DROP CONSTRAINT fk_57f6d41a7a7e4ac');
        $this->addSql('ALTER TABLE cave DROP CONSTRAINT fk_57f6d419c5573bc');
        $this->addSql('DROP TABLE cave');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE cave_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cave (id INT NOT NULL, utilistaeur_id_id INT DEFAULT NULL, id_vin_id INT NOT NULL, enter_date DATE NOT NULL, exit_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_57f6d419c5573bc ON cave (id_vin_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_57f6d41a7a7e4ac ON cave (utilistaeur_id_id)');
        $this->addSql('COMMENT ON COLUMN cave.enter_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cave.exit_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE cave ADD CONSTRAINT fk_57f6d41a7a7e4ac FOREIGN KEY (utilistaeur_id_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cave ADD CONSTRAINT fk_57f6d419c5573bc FOREIGN KEY (id_vin_id) REFERENCES vin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_vin DROP CONSTRAINT FK_3C44ED32FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_vin DROP CONSTRAINT FK_3C44ED32BA62C651');
        $this->addSql('DROP TABLE utilisateur_vin');
    }
}
