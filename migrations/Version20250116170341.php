<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116170341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD local_card_id INT NOT NULL, ADD away_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CD7199FAD FOREIGN KEY (local_card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C26B81F8C FOREIGN KEY (away_card_id) REFERENCES card (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318CD7199FAD ON game (local_card_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C26B81F8C ON game (away_card_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CD7199FAD');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C26B81F8C');
        $this->addSql('DROP INDEX UNIQ_232B318CD7199FAD ON game');
        $this->addSql('DROP INDEX UNIQ_232B318C26B81F8C ON game');
        $this->addSql('ALTER TABLE game DROP local_card_id, DROP away_card_id');
    }
}
