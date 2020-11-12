<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112095657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD address_street_number VARCHAR(255) NOT NULL, ADD address_city VARCHAR(255) NOT NULL, ADD address_zipcode VARCHAR(255) NOT NULL, CHANGE address address_street VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD address_street_number VARCHAR(255) NOT NULL, ADD address_city VARCHAR(255) NOT NULL, ADD address_zipcode VARCHAR(255) NOT NULL, CHANGE address address_street VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP address_street, DROP address_street_number, DROP address_city, DROP address_zipcode');
        $this->addSql('ALTER TABLE teacher ADD address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP address_street, DROP address_street_number, DROP address_city, DROP address_zipcode');
    }
}
