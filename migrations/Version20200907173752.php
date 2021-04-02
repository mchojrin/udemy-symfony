<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200907173752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applicant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birthdate DATE NOT NULL)');
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE company_owner (id INTEGER NOT NULL, company_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88914419979B1AD6 ON company_owner (company_id)');
        $this->addSql('CREATE TABLE job_offer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, company_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_288A3A4E979B1AD6 ON job_offer (company_id)');
        $this->addSql('CREATE TABLE job_offer_applicant (job_offer_id INTEGER NOT NULL, applicant_id INTEGER NOT NULL, PRIMARY KEY(job_offer_id, applicant_id))');
        $this->addSql('CREATE INDEX IDX_82F422B23481D195 ON job_offer_applicant (job_offer_id)');
        $this->addSql('CREATE INDEX IDX_82F422B297139001 ON job_offer_applicant (applicant_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT \'APP\')');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE applicant');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_owner');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_offer_applicant');
        $this->addSql('DROP TABLE user');
    }
}
