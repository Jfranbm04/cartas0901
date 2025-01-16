<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116173054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD local_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C5D5A2101 FOREIGN KEY (local_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_232B318C5D5A2101 ON game (local_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C5D5A2101');
        $this->addSql('DROP INDEX IDX_232B318C5D5A2101 ON game');
        $this->addSql('ALTER TABLE game DROP local_id');
    }
}
