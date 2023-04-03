<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222141500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D2FF631228');
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D2DDCE7E5F');
        $this->addSql('DROP INDEX IDX_14C967D2DDCE7E5F ON attributions');
        $this->addSql('DROP INDEX IDX_14C967D2FF631228 ON attributions');
        $this->addSql('ALTER TABLE attributions ADD offre_id INT DEFAULT NULL, DROP etablissement_id, DROP typeschambres_id');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D24CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_14C967D24CC8505A ON attributions (offre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D24CC8505A');
        $this->addSql('DROP INDEX IDX_14C967D24CC8505A ON attributions');
        $this->addSql('ALTER TABLE attributions ADD typeschambres_id INT DEFAULT NULL, CHANGE offre_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D2FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D2DDCE7E5F FOREIGN KEY (typeschambres_id) REFERENCES type_chambre (id)');
        $this->addSql('CREATE INDEX IDX_14C967D2DDCE7E5F ON attributions (typeschambres_id)');
        $this->addSql('CREATE INDEX IDX_14C967D2FF631228 ON attributions (etablissement_id)');
    }
}
