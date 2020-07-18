<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200718183406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added view model table for product';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE product_view (
                id varchar(128) NOT NULL,
                name varchar(128) NOT NULL,
                price decimal(10,2) DEFAULT 0 NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
                deleted_at DATETIME NULL,
                PRIMARY KEY(id)
                )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product_view');
    }
}
