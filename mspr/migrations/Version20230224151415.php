<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224151415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD post_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC4B89032C ON commentaire (post_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCA76ED395 ON commentaire (user_id)');
        $this->addSql('ALTER TABLE post ADD etat_id INT DEFAULT NULL, ADD hashtag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DFB34EF56 FOREIGN KEY (hashtag_id) REFERENCES hashtag (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DD5E86FF ON post (etat_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DFB34EF56 ON post (hashtag_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DD5E86FF');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DFB34EF56');
        $this->addSql('DROP INDEX IDX_5A8A6C8DD5E86FF ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8DFB34EF56 ON post');
        $this->addSql('ALTER TABLE post DROP etat_id, DROP hashtag_id');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC4B89032C');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('DROP INDEX IDX_67F068BC4B89032C ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BCA76ED395 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP post_id, DROP user_id');
    }
}
