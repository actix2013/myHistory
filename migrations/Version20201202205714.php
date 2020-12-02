<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202205714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        null == $schema ? false : true;
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history ADD timestamp DOUBLE PRECISION NOT NULL, ADD source VARCHAR(255) NOT NULL, ADD host VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        null == $schema ? false : true;
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history DROP timestamp, DROP source, DROP host');
    }
}
