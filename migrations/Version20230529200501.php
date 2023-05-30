<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529200501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cave_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cave (id INT NOT NULL, utilistaeur_id_id INT DEFAULT NULL, id_vin_id INT DEFAULT NULL, enter_date DATE NOT NULL, exit_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57F6D41A7A7E4AC ON cave (utilistaeur_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57F6D419C5573BC ON cave (id_vin_id)');
        $this->addSql('COMMENT ON COLUMN cave.enter_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cave.exit_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE cave ADD CONSTRAINT FK_57F6D41A7A7E4AC FOREIGN KEY (utilistaeur_id_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cave ADD CONSTRAINT FK_57F6D419C5573BC FOREIGN KEY (id_vin_id) REFERENCES vin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_vin DROP CONSTRAINT fk_3c44ed32fb88e14f');
        $this->addSql('ALTER TABLE utilisateur_vin DROP CONSTRAINT fk_3c44ed32ba62c651');
        $this->addSql('DROP TABLE utilisateur_vin');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cave_id_seq CASCADE');
        $this->addSql('CREATE TABLE utilisateur_vin (utilisateur_id INT NOT NULL, vin_id INT NOT NULL, PRIMARY KEY(utilisateur_id, vin_id))');
        $this->addSql('CREATE INDEX idx_3c44ed32ba62c651 ON utilisateur_vin (vin_id)');
        $this->addSql('CREATE INDEX idx_3c44ed32fb88e14f ON utilisateur_vin (utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateur_vin ADD CONSTRAINT fk_3c44ed32fb88e14f FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_vin ADD CONSTRAINT fk_3c44ed32ba62c651 FOREIGN KEY (vin_id) REFERENCES vin (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cave DROP CONSTRAINT FK_57F6D41A7A7E4AC');
        $this->addSql('ALTER TABLE cave DROP CONSTRAINT FK_57F6D419C5573BC');
        $this->addSql('DROP TABLE cave');
    }
}
