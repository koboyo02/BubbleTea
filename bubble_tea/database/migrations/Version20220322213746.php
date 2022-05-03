<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322213746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, shipping_address_id INT DEFAULT NULL, discount_code_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, total_price_without_discount DOUBLE PRECISION NOT NULL, total_price DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', completed_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E52FFDEEA76ED395 (user_id), UNIQUE INDEX UNIQ_E52FFDEE4D4CFF2B (shipping_address_id), INDEX IDX_E52FFDEE91D29306 (discount_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_items (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_A0B446EC727ACA70 (parent_id), INDEX IDX_A0B446EC4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_items_supplements (parent_id INT NOT NULL, supplement_id INT NOT NULL, INDEX IDX_B7D169F8727ACA70 (parent_id), INDEX IDX_B7D169F87793FA21 (supplement_id), PRIMARY KEY(parent_id, supplement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_shipping_addresses (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, INDEX IDX_8F75367D727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE4D4CFF2B FOREIGN KEY (shipping_address_id) REFERENCES orders_shipping_addresses (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE91D29306 FOREIGN KEY (discount_code_id) REFERENCES discount_codes (id)');
        $this->addSql('ALTER TABLE orders_items ADD CONSTRAINT FK_A0B446EC727ACA70 FOREIGN KEY (parent_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_items ADD CONSTRAINT FK_A0B446EC4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders_items_supplements ADD CONSTRAINT FK_B7D169F8727ACA70 FOREIGN KEY (parent_id) REFERENCES orders_items (id)');
        $this->addSql('ALTER TABLE orders_items_supplements ADD CONSTRAINT FK_B7D169F87793FA21 FOREIGN KEY (supplement_id) REFERENCES products_supplements (id)');
        $this->addSql('ALTER TABLE orders_shipping_addresses ADD CONSTRAINT FK_8F75367D727ACA70 FOREIGN KEY (parent_id) REFERENCES orders (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_items DROP FOREIGN KEY FK_A0B446EC727ACA70');
        $this->addSql('ALTER TABLE orders_shipping_addresses DROP FOREIGN KEY FK_8F75367D727ACA70');
        $this->addSql('ALTER TABLE orders_items_supplements DROP FOREIGN KEY FK_B7D169F8727ACA70');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE4D4CFF2B');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_items');
        $this->addSql('DROP TABLE orders_items_supplements');
        $this->addSql('DROP TABLE orders_shipping_addresses');
    }
}
