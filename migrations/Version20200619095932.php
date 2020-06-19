<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619095932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870DF9255BD');
        $this->addSql('DROP INDEX IDX_6BAF7870DF9255BD ON ingredient');
        $this->addSql('ALTER TABLE ingredient ADD liste_ingredient LONGTEXT NOT NULL, DROP categorie_aliment_id, DROP nom_ingredient, DROP quantite');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD categorie_aliment_id INT NOT NULL, ADD nom_ingredient VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD quantite DOUBLE PRECISION DEFAULT NULL, DROP liste_ingredient');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870DF9255BD FOREIGN KEY (categorie_aliment_id) REFERENCES categorie_aliment (id)');
        $this->addSql('CREATE INDEX IDX_6BAF7870DF9255BD ON ingredient (categorie_aliment_id)');
    }
}
