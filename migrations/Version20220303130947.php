<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303130947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(10) NOT NULL, l_name VARCHAR(100) NOT NULL, f_name VARCHAR(100) NOT NULL, state SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_product_like (person_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C285825F217BBB47 (person_id), INDEX IDX_C285825F4584665A (product_id), PRIMARY KEY(person_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, info LONGTEXT NOT NULL, public_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_product_like ADD CONSTRAINT FK_C285825F217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE person_product_like ADD CONSTRAINT FK_C285825F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person_product_like DROP FOREIGN KEY FK_C285825F217BBB47');
        $this->addSql('ALTER TABLE person_product_like DROP FOREIGN KEY FK_C285825F4584665A');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_product_like');
        $this->addSql('DROP TABLE product');
    }
}
