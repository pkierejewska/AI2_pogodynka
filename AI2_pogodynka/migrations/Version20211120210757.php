<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120210757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_2CE0D8118BAC62AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__measurement AS SELECT id, city_id, temperature, chance_of_precipitation, wind, humidity, cloudiness, date FROM measurement');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('CREATE TABLE measurement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER NOT NULL, temperature NUMERIC(10, 2) NOT NULL, chance_of_precipitation INTEGER NOT NULL, wind INTEGER NOT NULL, humidity INTEGER NOT NULL, cloudiness VARCHAR(255) NOT NULL COLLATE BINARY, date DATE NOT NULL, CONSTRAINT FK_2CE0D8118BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO measurement (id, city_id, temperature, chance_of_precipitation, wind, humidity, cloudiness, date) SELECT id, city_id, temperature, chance_of_precipitation, wind, humidity, cloudiness, date FROM __temp__measurement');
        $this->addSql('DROP TABLE __temp__measurement');
        $this->addSql('CREATE INDEX IDX_2CE0D8118BAC62AF ON measurement (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_2CE0D8118BAC62AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__measurement AS SELECT id, city_id, temperature, chance_of_precipitation, wind, humidity, cloudiness, date FROM measurement');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('CREATE TABLE measurement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER NOT NULL, temperature NUMERIC(10, 2) NOT NULL, chance_of_precipitation INTEGER NOT NULL, wind INTEGER NOT NULL, humidity INTEGER NOT NULL, cloudiness VARCHAR(255) NOT NULL, date DATE NOT NULL)');
        $this->addSql('INSERT INTO measurement (id, city_id, temperature, chance_of_precipitation, wind, humidity, cloudiness, date) SELECT id, city_id, temperature, chance_of_precipitation, wind, humidity, cloudiness, date FROM __temp__measurement');
        $this->addSql('DROP TABLE __temp__measurement');
        $this->addSql('CREATE INDEX IDX_2CE0D8118BAC62AF ON measurement (city_id)');
    }
}
