<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602003207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_57f6d419c5573bc');
        $this->addSql('DROP INDEX uniq_57f6d41a7a7e4ac');
        $this->addSql('ALTER TABLE cave ALTER utilistaeur_id_id SET NOT NULL');
        $this->addSql('ALTER TABLE cave ALTER id_vin_id SET NOT NULL');
        $this->addSql('CREATE INDEX IDX_57F6D41A7A7E4AC ON cave (utilistaeur_id_id)');
        $this->addSql('CREATE INDEX IDX_57F6D419C5573BC ON cave (id_vin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_57F6D41A7A7E4AC');
        $this->addSql('DROP INDEX IDX_57F6D419C5573BC');
        $this->addSql('ALTER TABLE cave ALTER utilistaeur_id_id DROP NOT NULL');
        $this->addSql('ALTER TABLE cave ALTER id_vin_id DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_57f6d419c5573bc ON cave (id_vin_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_57f6d41a7a7e4ac ON cave (utilistaeur_id_id)');
    }
}
