<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102092826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement ADD user_id INT DEFAULT NULL, DROP nomresponsable, DROP prenomresponsable');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_20FD592CA76ED395 ON etablissement (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CA76ED395');
        $this->addSql('DROP INDEX IDX_20FD592CA76ED395 ON etablissement');
        $this->addSql('ALTER TABLE etablissement ADD nomresponsable VARCHAR(50) NOT NULL, ADD prenomresponsable VARCHAR(50) NOT NULL, DROP user_id');
    }
}
