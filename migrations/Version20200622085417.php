<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200622085417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63904A8CA2AD');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP INDEX UNIQ_49BB63904A8CA2AD ON recette');
        $this->addSql('ALTER TABLE recette ADD etape LONGTEXT NOT NULL, DROP etape_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, etapes LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recette ADD etape_id INT NOT NULL, DROP etape');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63904A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_49BB63904A8CA2AD ON recette (etape_id)');
    }
}
