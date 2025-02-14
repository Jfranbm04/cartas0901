<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123185326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD local_card_id_2_id INT NOT NULL, ADD away_card_id_2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CF59E2FD FOREIGN KEY (local_card_id_2_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CCBBCB5D9 FOREIGN KEY (away_card_id_2_id) REFERENCES card (id)');
        $this->addSql('CREATE INDEX IDX_232B318CF59E2FD ON game (local_card_id_2_id)');
        $this->addSql('CREATE INDEX IDX_232B318CCBBCB5D9 ON game (away_card_id_2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CF59E2FD');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CCBBCB5D9');
        $this->addSql('DROP INDEX IDX_232B318CF59E2FD ON game');
        $this->addSql('DROP INDEX IDX_232B318CCBBCB5D9 ON game');
        $this->addSql('ALTER TABLE game DROP local_card_id_2_id, DROP away_card_id_2_id');
    }
}
