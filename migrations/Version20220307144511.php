<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307144511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atribuer (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, competence_id INT DEFAULT NULL, nb_valider INT DEFAULT NULL, INDEX IDX_D6182843A76ED395 (user_id), INDEX IDX_D618284315761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, type_competence_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, note INT DEFAULT NULL, INDEX IDX_94D4687F659BAA9E (type_competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, emetteur_id INT NOT NULL, recepteur_id INT NOT NULL, message VARCHAR(255) NOT NULL, date_message DATETIME NOT NULL, vu TINYINT(1) NOT NULL, INDEX IDX_4C62E63879E92E8C (emetteur_id), INDEX IDX_4C62E6383B49782D (recepteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_competence (id INT AUTO_INCREMENT NOT NULL, matiere_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_89D7BE5AF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, id_unique VARCHAR(25) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atribuer ADD CONSTRAINT FK_D6182843A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE atribuer ADD CONSTRAINT FK_D618284315761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F659BAA9E FOREIGN KEY (type_competence_id) REFERENCES type_competence (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63879E92E8C FOREIGN KEY (emetteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6383B49782D FOREIGN KEY (recepteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE type_competence ADD CONSTRAINT FK_89D7BE5AF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atribuer DROP FOREIGN KEY FK_D618284315761DAB');
        $this->addSql('ALTER TABLE type_competence DROP FOREIGN KEY FK_89D7BE5AF46CD258');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F659BAA9E');
        $this->addSql('ALTER TABLE atribuer DROP FOREIGN KEY FK_D6182843A76ED395');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63879E92E8C');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6383B49782D');
        $this->addSql('DROP TABLE atribuer');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE type_competence');
        $this->addSql('DROP TABLE user');
    }
}
