<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905071056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE albulm (id INT AUTO_INCREMENT NOT NULL, artiste_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_17F64B6D21D25844 (artiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, site VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE morceau (id INT AUTO_INCREMENT NOT NULL, albulm_id INT NOT NULL, titre VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, INDEX IDX_36BB7208611D5CB3 (albulm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE albulm ADD CONSTRAINT FK_17F64B6D21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE morceau ADD CONSTRAINT FK_36BB7208611D5CB3 FOREIGN KEY (albulm_id) REFERENCES albulm (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE albulm DROP FOREIGN KEY FK_17F64B6D21D25844');
        $this->addSql('ALTER TABLE morceau DROP FOREIGN KEY FK_36BB7208611D5CB3');
        $this->addSql('DROP TABLE albulm');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE morceau');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
