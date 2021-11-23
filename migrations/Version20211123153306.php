<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123153306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence ADD type_competence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F659BAA9E FOREIGN KEY (type_competence_id) REFERENCES type_competence (id)');
        $this->addSql('CREATE INDEX IDX_94D4687F659BAA9E ON competence (type_competence_id)');
        $this->addSql('ALTER TABLE type_competence ADD matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_competence ADD CONSTRAINT FK_89D7BE5AF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_89D7BE5AF46CD258 ON type_competence (matiere_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F659BAA9E');
        $this->addSql('DROP INDEX IDX_94D4687F659BAA9E ON competence');
        $this->addSql('ALTER TABLE competence DROP type_competence_id');
        $this->addSql('ALTER TABLE type_competence DROP FOREIGN KEY FK_89D7BE5AF46CD258');
        $this->addSql('DROP INDEX IDX_89D7BE5AF46CD258 ON type_competence');
        $this->addSql('ALTER TABLE type_competence DROP matiere_id');
    }
}
