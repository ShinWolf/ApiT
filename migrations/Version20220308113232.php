<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308113232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63829AE5C73');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6383B1BF39D');
        $this->addSql('DROP INDEX IDX_4C62E63829AE5C73 ON contact');
        $this->addSql('DROP INDEX IDX_4C62E6383B1BF39D ON contact');
        $this->addSql('ALTER TABLE contact ADD emetteur_id INT NOT NULL, ADD recepteur_id INT NOT NULL, DROP util1_id, DROP util2_id');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63879E92E8C FOREIGN KEY (emetteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6383B49782D FOREIGN KEY (recepteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63879E92E8C ON contact (emetteur_id)');
        $this->addSql('CREATE INDEX IDX_4C62E6383B49782D ON contact (recepteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63879E92E8C');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6383B49782D');
        $this->addSql('DROP INDEX IDX_4C62E63879E92E8C ON contact');
        $this->addSql('DROP INDEX IDX_4C62E6383B49782D ON contact');
        $this->addSql('ALTER TABLE contact ADD util1_id INT NOT NULL, ADD util2_id INT NOT NULL, DROP emetteur_id, DROP recepteur_id');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63829AE5C73 FOREIGN KEY (util2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6383B1BF39D FOREIGN KEY (util1_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63829AE5C73 ON contact (util2_id)');
        $this->addSql('CREATE INDEX IDX_4C62E6383B1BF39D ON contact (util1_id)');
    }
}
