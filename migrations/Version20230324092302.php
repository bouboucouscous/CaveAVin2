<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324092302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE robe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE teneur_en_sucre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE utilisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE robe (id INT NOT NULL, couleur_robe VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE teneur_en_sucre (id INT NOT NULL, gout VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE utilisateur (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nb_place_bouteillle INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3F85E0677 ON utilisateur (username)');
        $this->addSql('CREATE TABLE utilisateur_vin (utilisateur_id INT NOT NULL, vin_id INT NOT NULL, PRIMARY KEY(utilisateur_id, vin_id))');
        $this->addSql('CREATE INDEX IDX_3C44ED32FB88E14F ON utilisateur_vin (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_3C44ED32BA62C651 ON utilisateur_vin (vin_id)');
        $this->addSql('CREATE TABLE vin (id INT NOT NULL, robe_id INT NOT NULL, teneur_en_sucre_id INT NOT NULL, nom VARCHAR(255) NOT NULL, annee DATE NOT NULL, format_cl INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B108514169339CCD ON vin (robe_id)');
        $this->addSql('CREATE INDEX IDX_B1085141F7225AF6 ON vin (teneur_en_sucre_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE utilisateur_vin ADD CONSTRAINT FK_3C44ED32FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur_vin ADD CONSTRAINT FK_3C44ED32BA62C651 FOREIGN KEY (vin_id) REFERENCES vin (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vin ADD CONSTRAINT FK_B108514169339CCD FOREIGN KEY (robe_id) REFERENCES robe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vin ADD CONSTRAINT FK_B1085141F7225AF6 FOREIGN KEY (teneur_en_sucre_id) REFERENCES teneur_en_sucre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE robe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE teneur_en_sucre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE utilisateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vin_id_seq CASCADE');
        $this->addSql('ALTER TABLE utilisateur_vin DROP CONSTRAINT FK_3C44ED32FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_vin DROP CONSTRAINT FK_3C44ED32BA62C651');
        $this->addSql('ALTER TABLE vin DROP CONSTRAINT FK_B108514169339CCD');
        $this->addSql('ALTER TABLE vin DROP CONSTRAINT FK_B1085141F7225AF6');
        $this->addSql('DROP TABLE robe');
        $this->addSql('DROP TABLE teneur_en_sucre');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_vin');
        $this->addSql('DROP TABLE vin');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
