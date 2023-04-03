<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005130243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, typeschambres_id INT DEFAULT NULL, INDEX IDX_AF86866FFF631228 (etablissement_id), INDEX IDX_AF86866FDDCE7E5F (typeschambres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FDDCE7E5F FOREIGN KEY (typeschambres_id) REFERENCES type_chambre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FFF631228');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FDDCE7E5F');
        $this->addSql('DROP TABLE offre');
    }
}
