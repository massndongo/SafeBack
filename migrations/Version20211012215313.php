<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012215313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, date_command DATE NOT NULL, adresse VARCHAR(255) DEFAULT NULL, nom_client VARCHAR(255) DEFAULT NULL, numero_client VARCHAR(255) DEFAULT NULL, ordonnance LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_ponctuel (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, nom_client VARCHAR(255) NOT NULL, numero_client VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_ponctuel_medicament (command_ponctuel_id INT NOT NULL, medicament_id INT NOT NULL, INDEX IDX_221F3BBF80F18799 (command_ponctuel_id), INDEX IDX_221F3BBFAB0D61F7 (medicament_id), PRIMARY KEY(command_ponctuel_id, medicament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, quantite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, profile VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_ponctuel_medicament ADD CONSTRAINT FK_221F3BBF80F18799 FOREIGN KEY (command_ponctuel_id) REFERENCES command_ponctuel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_ponctuel_medicament ADD CONSTRAINT FK_221F3BBFAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_ponctuel_medicament DROP FOREIGN KEY FK_221F3BBF80F18799');
        $this->addSql('ALTER TABLE command_ponctuel_medicament DROP FOREIGN KEY FK_221F3BBFAB0D61F7');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_ponctuel');
        $this->addSql('DROP TABLE command_ponctuel_medicament');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE user');
    }
}
