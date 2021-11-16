<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116134042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, num_service_id INT DEFAULT NULL, INDEX IDX_C509E4FF624BE96D (num_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sejour (id INT AUTO_INCREMENT NOT NULL, num_chambre_id INT DEFAULT NULL, num_patient_id INT DEFAULT NULL, date_arrivee DATE DEFAULT NULL, date_depart DATE DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_96F5202814003FDF (num_chambre_id), INDEX IDX_96F52028E49ED2F2 (num_patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, num_service_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649624BE96D (num_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF624BE96D FOREIGN KEY (num_service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F5202814003FDF FOREIGN KEY (num_chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F52028E49ED2F2 FOREIGN KEY (num_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649624BE96D FOREIGN KEY (num_service_id) REFERENCES service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F5202814003FDF');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F52028E49ED2F2');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF624BE96D');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649624BE96D');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE sejour');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE `user`');
    }
}
