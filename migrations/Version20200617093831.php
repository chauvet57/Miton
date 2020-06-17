<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617093831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aliment (id INT AUTO_INCREMENT NOT NULL, nom_aliment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_recette (categorie_id INT NOT NULL, recette_id INT NOT NULL, INDEX IDX_1638CD32BCF5E72D (categorie_id), INDEX IDX_1638CD3289312FE9 (recette_id), PRIMARY KEY(categorie_id, recette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_aliment (id INT AUTO_INCREMENT NOT NULL, nom_categorie_aliment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_aliment_aliment (categorie_aliment_id INT NOT NULL, aliment_id INT NOT NULL, INDEX IDX_4A497D49DF9255BD (categorie_aliment_id), INDEX IDX_4A497D49415B9F11 (aliment_id), PRIMARY KEY(categorie_aliment_id, aliment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, note_id INT NOT NULL, commentaire LONGTEXT NOT NULL, pseudo VARCHAR(255) NOT NULL, INDEX IDX_67F068BC26ED0855 (note_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE difficulte (id INT AUTO_INCREMENT NOT NULL, nom_difficulte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, etapes LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, categorie_aliment_id INT NOT NULL, nom_ingredient VARCHAR(255) NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_6BAF7870DF9255BD (categorie_aliment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_unite_mesure (ingredient_id INT NOT NULL, unite_mesure_id INT NOT NULL, INDEX IDX_6F0790AA933FE08C (ingredient_id), INDEX IDX_6F0790AAC75A06BF (unite_mesure_id), PRIMARY KEY(ingredient_id, unite_mesure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, nom_note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, nom_prix VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, nom_recette VARCHAR(255) NOT NULL, valide TINYINT(1) NOT NULL, temps TIME NOT NULL, nombre_personne INT NOT NULL, image LONGTEXT NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_ingredient (recette_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_17C041A989312FE9 (recette_id), INDEX IDX_17C041A9933FE08C (ingredient_id), PRIMARY KEY(recette_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite_mesure (id INT AUTO_INCREMENT NOT NULL, nom_unite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_recette ADD CONSTRAINT FK_1638CD32BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_recette ADD CONSTRAINT FK_1638CD3289312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_aliment_aliment ADD CONSTRAINT FK_4A497D49DF9255BD FOREIGN KEY (categorie_aliment_id) REFERENCES categorie_aliment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_aliment_aliment ADD CONSTRAINT FK_4A497D49415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC26ED0855 FOREIGN KEY (note_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870DF9255BD FOREIGN KEY (categorie_aliment_id) REFERENCES categorie_aliment (id)');
        $this->addSql('ALTER TABLE ingredient_unite_mesure ADD CONSTRAINT FK_6F0790AA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_unite_mesure ADD CONSTRAINT FK_6F0790AAC75A06BF FOREIGN KEY (unite_mesure_id) REFERENCES unite_mesure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_aliment_aliment DROP FOREIGN KEY FK_4A497D49415B9F11');
        $this->addSql('ALTER TABLE categorie_recette DROP FOREIGN KEY FK_1638CD32BCF5E72D');
        $this->addSql('ALTER TABLE categorie_aliment_aliment DROP FOREIGN KEY FK_4A497D49DF9255BD');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870DF9255BD');
        $this->addSql('ALTER TABLE ingredient_unite_mesure DROP FOREIGN KEY FK_6F0790AA933FE08C');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC26ED0855');
        $this->addSql('ALTER TABLE categorie_recette DROP FOREIGN KEY FK_1638CD3289312FE9');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9');
        $this->addSql('ALTER TABLE ingredient_unite_mesure DROP FOREIGN KEY FK_6F0790AAC75A06BF');
        $this->addSql('DROP TABLE aliment');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_recette');
        $this->addSql('DROP TABLE categorie_aliment');
        $this->addSql('DROP TABLE categorie_aliment_aliment');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE difficulte');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_unite_mesure');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_ingredient');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE unite_mesure');
        $this->addSql('DROP TABLE users');
    }
}
