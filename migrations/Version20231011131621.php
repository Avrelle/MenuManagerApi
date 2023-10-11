<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011131621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_order_description (menu_id INT NOT NULL, order_description_id INT NOT NULL, INDEX IDX_5B68EFD3CCD7E912 (menu_id), INDEX IDX_5B68EFD365EF46DB (order_description_id), PRIMARY KEY(menu_id, order_description_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_order_description ADD CONSTRAINT FK_5B68EFD3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_order_description ADD CONSTRAINT FK_5B68EFD365EF46DB FOREIGN KEY (order_description_id) REFERENCES order_description (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_description DROP order_numero');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_order_description DROP FOREIGN KEY FK_5B68EFD3CCD7E912');
        $this->addSql('ALTER TABLE menu_order_description DROP FOREIGN KEY FK_5B68EFD365EF46DB');
        $this->addSql('DROP TABLE menu_order_description');
        $this->addSql('ALTER TABLE order_description ADD order_numero INT NOT NULL');
    }
}
