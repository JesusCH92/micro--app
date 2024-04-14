<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412200209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(30) NOT NULL, model VARCHAR(40) NOT NULL, plate VARCHAR(40) NOT NULL, license_required VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Toyota', 'Corolla', 'ABC111', 'Y')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Toyota', 'Corolla', 'ABC222', 'Y')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Toyota', 'Corolla', 'ABC333', 'Y')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Toyota', 'Corolla', 'ABC444', 'Y')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Ford', 'Focus', 'XYZ777', 'N')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Ford', 'Focus', 'XYZ888', 'N')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Ford', 'Focus', 'XYZ999', 'N')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Ford', 'Focus', 'XYZ111', 'N')");
        $this->addSql("INSERT INTO vehicle (brand, model, plate, license_required) VALUES ('Ford', 'Fiesta', 'XYZ111', 'A')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vehicle');
    }
}
