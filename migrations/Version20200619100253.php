<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619100253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ingredient_unite_mesure');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient_unite_mesure (ingredient_id INT NOT NULL, unite_mesure_id INT NOT NULL, INDEX IDX_6F0790AAC75A06BF (unite_mesure_id), INDEX IDX_6F0790AA933FE08C (ingredient_id), PRIMARY KEY(ingredient_id, unite_mesure_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ingredient_unite_mesure ADD CONSTRAINT FK_6F0790AA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_unite_mesure ADD CONSTRAINT FK_6F0790AAC75A06BF FOREIGN KEY (unite_mesure_id) REFERENCES unite_mesure (id) ON DELETE CASCADE');
    }
}
