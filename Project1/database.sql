CREATE DATABASE IF NOT EXISTS 67shop_db
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE 67shop_db;

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    color VARCHAR(50) NOT NULL
);

INSERT INTO books (title, author, price, category, color) VALUES
('Atomic Habits', 'James Clear', 395, 'พัฒนาตนเอง', 'blue'),
('มหาเวทย์ผนึกมาร เล่ม 1', 'Gege Akutami', 95, 'การ์ตูน', 'purple'),
('Sapiens', 'Yuval Noah Harari', 450, 'ความรู้', 'brown'),
('The Psychology of Money', 'Morgan Housel', 390, 'ธุรกิจ', 'navy'),
('เพราะเรายังคงเป็นดาวดวงเดิม', 'นักเขียนไทย', 299, 'นิยาย', 'orange'),
('Clean Code', 'Robert C. Martin', 520, 'เทคโนโลยี', 'teal'),
('Don''t Make Me Think', 'Steve Krug', 430, 'เทคโนโลยี', 'red'),
('The Little Prince', 'Antoine de Saint-Exupéry', 220, 'วรรณกรรม', 'green');