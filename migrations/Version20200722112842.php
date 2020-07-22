<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200722112842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, establishment_name VARCHAR(45) NOT NULL, title VARCHAR(255) DEFAULT NULL, date_start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, comment VARCHAR(90) DEFAULT NULL, mission LONGTEXT DEFAULT NULL, link_git_hub VARCHAR(300) DEFAULT NULL, link_website VARCHAR(300) DEFAULT NULL, link_establishment VARCHAR(300) DEFAULT NULL, establishment_department_nb VARCHAR(20) DEFAULT NULL, type INT DEFAULT NULL, INDEX IDX_9067F23CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_skill (mission_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_CEABBB4ABE6CAE90 (mission_id), INDEX IDX_CEABBB4A5585C142 (skill_id), PRIMARY KEY(mission_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mission_skill ADD CONSTRAINT FK_CEABBB4ABE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_skill ADD CONSTRAINT FK_CEABBB4A5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission_skill DROP FOREIGN KEY FK_CEABBB4ABE6CAE90');
        $this->addSql('ALTER TABLE mission_skill DROP FOREIGN KEY FK_CEABBB4A5585C142');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_skill');
        $this->addSql('DROP TABLE skill');
    }
}
