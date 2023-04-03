<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005125810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attributions (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, typeschambres_id INT DEFAULT NULL, groupes_id INT DEFAULT NULL, nombreschambres VARCHAR(50) NOT NULL, INDEX IDX_14C967D2FF631228 (etablissement_id), INDEX IDX_14C967D2DDCE7E5F (typeschambres_id), INDEX IDX_14C967D2305371B (groupes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D2FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D2DDCE7E5F FOREIGN KEY (typeschambres_id) REFERENCES type_chambre (id)');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D2305371B FOREIGN KEY (groupes_id) REFERENCES groupes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D2FF631228');
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D2DDCE7E5F');
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D2305371B');
        $this->addSql('DROP TABLE attributions');
    }
}
