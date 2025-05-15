CREATE DATABASE IF NOT EXISTS electronics_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE electronics_shop;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products (name, description, price, category, image) VALUES
('ASUS VivoBook 15 X515EA', '15.6" IPS, Intel Core i3, 8GB RAM, 256GB SSD', 45990.00, 'Ноутбуки', 'asuslogo.jpg'),
('Смартфон Samsung Galaxy А54', '6.4" AMOLED, 128GB, 5000mAh', 32990.00, 'Смартфоны', 'samsungPhone.jpg'),
('Sony WH-1000XM4', 'Беспроводные наушники Sony WH-1000XM4', 29990.00, 'Аудио', 'sonyHeadphones.jpg'),
