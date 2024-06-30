<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200223194955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create "News" table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof AbstractMySQLPlatform,
            "Migration can only be executed safely on mysql."
        );

        $this->addSql('CREATE TABLE tw1_news (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, summary VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME DEFAULT NULL, INDEX IDX_2D0564F8166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tw1_news ADD CONSTRAINT FK_2D0564F8166D1F9C FOREIGN KEY (project_id) REFERENCES tw1_project (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof AbstractMySQLPlatform,
            "Migration can only be executed safely on mysql."
        );

        $this->addSql('DROP TABLE tw1_news');
    }
}
