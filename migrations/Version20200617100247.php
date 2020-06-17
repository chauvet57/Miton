<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617100247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD recette_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC89312FE9 ON commentaire (recette_id)');
        $this->addSql('ALTER TABLE recette ADD user_id INT NOT NULL, ADD prix_id INT NOT NULL, ADD difficulte_id INT NOT NULL, ADD etape_id INT NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390E6357589 FOREIGN KEY (difficulte_id) REFERENCES difficulte (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63904A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id)');
        $this->addSql('CREATE INDEX IDX_49BB6390A76ED395 ON recette (user_id)');
        $this->addSql('CREATE INDEX IDX_49BB6390944722F2 ON recette (prix_id)');
        $this->addSql('CREATE INDEX IDX_49BB6390E6357589 ON recette (difficulte_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_49BB63904A8CA2AD ON recette (etape_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC89312FE9');
        $this->addSql('DROP INDEX IDX_67F068BC89312FE9 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP recette_id');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390A76ED395');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390944722F2');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390E6357589');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63904A8CA2AD');
        $this->addSql('DROP INDEX IDX_49BB6390A76ED395 ON recette');
        $this->addSql('DROP INDEX IDX_49BB6390944722F2 ON recette');
        $this->addSql('DROP INDEX IDX_49BB6390E6357589 ON recette');
        $this->addSql('DROP INDEX UNIQ_49BB63904A8CA2AD ON recette');
        $this->addSql('ALTER TABLE recette DROP user_id, DROP prix_id, DROP difficulte_id, DROP etape_id');
    }
}
