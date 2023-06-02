<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523121713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_vin (utilisateur_id VARCHAR(255) NOT NULL, vin_id VARCHAR(255) NOT NULL, enter_date DATE NOT NULL, note INT DEFAULT NULL, exit_date DATE DEFAULT NULL, PRIMARY KEY(utilisateur_id, vin_id))');
        $this->addSql('COMMENT ON COLUMN utilisateur_vin.enter_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN utilisateur_vin.exit_date IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE utilisateur_vin');
    }
}
