<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250215081626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, auteur_id_id INT DEFAULT NULL, cible_id_id INT NOT NULL, note INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, statut VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8F91ABF075F8742E (auteur_id_id), INDEX IDX_8F91ABF0E7A2C293 (cible_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE covoiturage (id INT AUTO_INCREMENT NOT NULL, conducteur_id_id INT DEFAULT NULL, voiture_id_id INT DEFAULT NULL, date_depart DATE NOT NULL, heure_depart TIME NOT NULL, ville_depart VARCHAR(100) NOT NULL, date_arrive DATE NOT NULL, heure_arrive TIME NOT NULL, ville_arrive VARCHAR(100) NOT NULL, statut VARCHAR(100) NOT NULL, nombre_places INT NOT NULL, prix_par_personne INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_28C79E8924F8F475 (conducteur_id_id), INDEX IDX_28C79E8952E93BA0 (voiture_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE covoiturage_user (covoiturage_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F862CC4962671590 (covoiturage_id), INDEX IDX_F862CC49A76ED395 (user_id), PRIMARY KEY(covoiturage_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, covoiturage_id_id INT NOT NULL, role VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AB55E24F9D86650F (user_id_id), INDEX IDX_AB55E24F7F316F4D (covoiturage_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plainte (id INT AUTO_INCREMENT NOT NULL, covoiturage_id_id INT NOT NULL, plaignant_id_id INT NOT NULL, cible_id_id INT NOT NULL, detail LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D88CE90F7F316F4D (covoiturage_id_id), INDEX IDX_D88CE90F7518254B (plaignant_id_id), INDEX IDX_D88CE90FE7A2C293 (cible_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, photo LONGBLOB DEFAULT NULL, credit INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_preference (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, fumeur TINYINT(1) NOT NULL, animaux TINYINT(1) NOT NULL, preference VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_FA0E76BF9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, used_id_id INT NOT NULL, marque VARCHAR(50) NOT NULL, modele VARCHAR(50) NOT NULL, couleur VARCHAR(50) NOT NULL, energie VARCHAR(50) NOT NULL, immatriculation VARCHAR(50) NOT NULL, date_first_immatriculation DATE NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_E9E2810FBE73422E (immatriculation), INDEX IDX_E9E2810F9988CCFB (used_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF075F8742E FOREIGN KEY (auteur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0E7A2C293 FOREIGN KEY (cible_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE covoiturage ADD CONSTRAINT FK_28C79E8924F8F475 FOREIGN KEY (conducteur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE covoiturage ADD CONSTRAINT FK_28C79E8952E93BA0 FOREIGN KEY (voiture_id_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE covoiturage_user ADD CONSTRAINT FK_F862CC4962671590 FOREIGN KEY (covoiturage_id) REFERENCES covoiturage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE covoiturage_user ADD CONSTRAINT FK_F862CC49A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F7F316F4D FOREIGN KEY (covoiturage_id_id) REFERENCES covoiturage (id)');
        $this->addSql('ALTER TABLE plainte ADD CONSTRAINT FK_D88CE90F7F316F4D FOREIGN KEY (covoiturage_id_id) REFERENCES covoiturage (id)');
        $this->addSql('ALTER TABLE plainte ADD CONSTRAINT FK_D88CE90F7518254B FOREIGN KEY (plaignant_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE plainte ADD CONSTRAINT FK_D88CE90FE7A2C293 FOREIGN KEY (cible_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_preference ADD CONSTRAINT FK_FA0E76BF9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F9988CCFB FOREIGN KEY (used_id_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF075F8742E');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0E7A2C293');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E8924F8F475');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E8952E93BA0');
        $this->addSql('ALTER TABLE covoiturage_user DROP FOREIGN KEY FK_F862CC4962671590');
        $this->addSql('ALTER TABLE covoiturage_user DROP FOREIGN KEY FK_F862CC49A76ED395');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F9D86650F');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F7F316F4D');
        $this->addSql('ALTER TABLE plainte DROP FOREIGN KEY FK_D88CE90F7F316F4D');
        $this->addSql('ALTER TABLE plainte DROP FOREIGN KEY FK_D88CE90F7518254B');
        $this->addSql('ALTER TABLE plainte DROP FOREIGN KEY FK_D88CE90FE7A2C293');
        $this->addSql('ALTER TABLE user_preference DROP FOREIGN KEY FK_FA0E76BF9D86650F');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F9988CCFB');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE covoiturage');
        $this->addSql('DROP TABLE covoiturage_user');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE plainte');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_preference');
        $this->addSql('DROP TABLE voiture');
    }
}
