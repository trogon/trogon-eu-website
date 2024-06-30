<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712205808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create "project" table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof AbstractMySQLPlatform,
            "Migration can only be executed safely on mysql."
        );

        $this->addSql('CREATE TABLE tw1_project (id INT AUTO_INCREMENT NOT NULL, provider VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, license VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, repo_link VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, language VARCHAR(20) DEFAULT NULL, is_private TINYINT(1) NOT NULL, is_archived TINYINT(1) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof AbstractMySQLPlatform,
            "Migration can only be executed safely on mysql."
        );

        $this->addSql('DROP TABLE tw1_project');
    }
}
