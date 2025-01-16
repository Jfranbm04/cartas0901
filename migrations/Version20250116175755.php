<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116175755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, away_id INT DEFAULT NULL, local_card_id INT NOT NULL, away_card_id INT DEFAULT NULL, result INT DEFAULT NULL, INDEX IDX_232B318C5D5A2101 (local_id), INDEX IDX_232B318C8DEF089F (away_id), INDEX IDX_232B318CD7199FAD (local_card_id), INDEX IDX_232B318C26B81F8C (away_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C5D5A2101 FOREIGN KEY (local_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C8DEF089F FOREIGN KEY (away_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CD7199FAD FOREIGN KEY (local_card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C26B81F8C FOREIGN KEY (away_card_id) REFERENCES card (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C5D5A2101');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C8DEF089F');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CD7199FAD');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C26B81F8C');
        $this->addSql('DROP TABLE game');
    }
}
