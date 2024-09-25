<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240918125246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, couleur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style_album (style_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_F34D20B8BACD6074 (style_id), INDEX IDX_F34D20B81137ABCF (album_id), PRIMARY KEY(style_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE style_album ADD CONSTRAINT FK_F34D20B8BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE style_album ADD CONSTRAINT FK_F34D20B81137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE album RENAME INDEX idx_17f64b6d21d25844 TO IDX_39986E4321D25844');
        $this->addSql('ALTER TABLE artiste CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE morceau CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE morceau RENAME INDEX idx_36bb7208611d5cb3 TO IDX_36BB72081137ABCF');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE style_album DROP FOREIGN KEY FK_F34D20B8BACD6074');
        $this->addSql('ALTER TABLE style_album DROP FOREIGN KEY FK_F34D20B81137ABCF');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE style_album');
        $this->addSql('ALTER TABLE album CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE album RENAME INDEX idx_39986e4321d25844 TO IDX_17F64B6D21D25844');
        $this->addSql('ALTER TABLE artiste CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE morceau CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE morceau RENAME INDEX idx_36bb72081137abcf TO IDX_36BB7208611D5CB3');
    }
}
