<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231111080916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, equipe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `show` (num_show INT AUTO_INCREMENT NOT NULL, theater_plays_id INT DEFAULT NULL, nbr_seat INT NOT NULL, date_show DATE NOT NULL, INDEX IDX_320ED901DF7E7ED3 (theater_plays_id), PRIMARY KEY(num_show)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theater_play (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theatre_play (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, joueur_id INT DEFAULT NULL, date DATE NOT NULL, note_vote INT NOT NULL, INDEX IDX_5A108564A9E2D76C (joueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT FK_320ED901DF7E7ED3 FOREIGN KEY (theater_plays_id) REFERENCES theater_play (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED901DF7E7ED3');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564A9E2D76C');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE `show`');
        $this->addSql('DROP TABLE theater_play');
        $this->addSql('DROP TABLE theatre_play');
        $this->addSql('DROP TABLE vote');
    }
}
