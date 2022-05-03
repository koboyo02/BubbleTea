-- Doctrine Migration File Generated on 2022-03-25 09:34:24

-- Version Database\Migrations\Version20220322190701
CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, remember_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

-- Version Database\Migrations\Version20220322202503
CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, remaining_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

-- Version Database\Migrations\Version20220322203036
CREATE TABLE products_supplements (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, remaining_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

-- Version Database\Migrations\Version20220322203949
CREATE TABLE discount_codes (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(10) NOT NULL, max_uses INT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', expire_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

-- Version Database\Migrations\Version20220322213746
CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, shipping_address_id INT DEFAULT NULL, discount_code_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, total_price_without_discount DOUBLE PRECISION NOT NULL, total_price DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', completed_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_E52FFDEEA76ED395 (user_id), UNIQUE INDEX UNIQ_E52FFDEE4D4CFF2B (shipping_address_id), INDEX IDX_E52FFDEE91D29306 (discount_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
CREATE TABLE orders_items (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_A0B446EC727ACA70 (parent_id), INDEX IDX_A0B446EC4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
CREATE TABLE orders_items_supplements (parent_id INT NOT NULL, supplement_id INT NOT NULL, INDEX IDX_B7D169F8727ACA70 (parent_id), INDEX IDX_B7D169F87793FA21 (supplement_id), PRIMARY KEY(parent_id, supplement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
CREATE TABLE orders_shipping_addresses (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, INDEX IDX_8F75367D727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE4D4CFF2B FOREIGN KEY (shipping_address_id) REFERENCES orders_shipping_addresses (id);
ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE91D29306 FOREIGN KEY (discount_code_id) REFERENCES discount_codes (id);
ALTER TABLE orders_items ADD CONSTRAINT FK_A0B446EC727ACA70 FOREIGN KEY (parent_id) REFERENCES orders (id);
ALTER TABLE orders_items ADD CONSTRAINT FK_A0B446EC4584665A FOREIGN KEY (product_id) REFERENCES products (id);
ALTER TABLE orders_items_supplements ADD CONSTRAINT FK_B7D169F8727ACA70 FOREIGN KEY (parent_id) REFERENCES orders_items (id);
ALTER TABLE orders_items_supplements ADD CONSTRAINT FK_B7D169F87793FA21 FOREIGN KEY (supplement_id) REFERENCES products_supplements (id);
ALTER TABLE orders_shipping_addresses ADD CONSTRAINT FK_8F75367D727ACA70 FOREIGN KEY (parent_id) REFERENCES orders (id);

-- Version Database\Migrations\Version20220323083043
ALTER TABLE orders CHANGE user_id user_id INT DEFAULT NULL;

-- Version Database\Migrations\Version20220324110051
CREATE TABLE users_shipping_addresses (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, INDEX IDX_6AF0617D727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
ALTER TABLE users_shipping_addresses ADD CONSTRAINT FK_6AF0617D727ACA70 FOREIGN KEY (parent_id) REFERENCES users (id);
