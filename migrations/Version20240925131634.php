<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925131634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album RENAME INDEX idx_17f64b6d21d25844 TO IDX_39986E4321D25844');
        $this->addSql('ALTER TABLE morceau RENAME INDEX idx_36bb7208611d5cb3 TO IDX_36BB72081137ABCF');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album RENAME INDEX idx_39986e4321d25844 TO IDX_17F64B6D21D25844');
        $this->addSql('ALTER TABLE morceau RENAME INDEX idx_36bb72081137abcf TO IDX_36BB7208611D5CB3');
    }
}
