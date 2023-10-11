<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011135007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_description_plate (order_description_id INT NOT NULL, plate_id INT NOT NULL, INDEX IDX_7FD141E265EF46DB (order_description_id), INDEX IDX_7FD141E2DF66E98B (plate_id), PRIMARY KEY(order_description_id, plate_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_description_plate ADD CONSTRAINT FK_7FD141E265EF46DB FOREIGN KEY (order_description_id) REFERENCES order_description (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_description_plate ADD CONSTRAINT FK_7FD141E2DF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_description_plate DROP FOREIGN KEY FK_7FD141E265EF46DB');
        $this->addSql('ALTER TABLE order_description_plate DROP FOREIGN KEY FK_7FD141E2DF66E98B');
        $this->addSql('DROP TABLE order_description_plate');
    }
}
