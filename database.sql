DROP DATABASE IF EXISTS bitlux;
CREATE DATABASE bitlux;
USE bitlux;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password)
VALUES 
('Robert', 'hoi'),
('andy', 'moi'),
('pater', 'stok');

CREATE TABLE product (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100) NOT NULL,
    beschrijving TEXT NOT NULL,
    foto1 VARCHAR(255) NOT NULL,
    foto2 VARCHAR(255) NOT NULL,
    foto3 VARCHAR(255) NOT NULL,
    prijs FLOAT NOT NULL,
    Categorie VARCHAR NOT NULL
);

CREATE TABLE winkelmand (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productid INT NOT NULL
);

INSERT INTO product (naam, beschrijving, foto1, foto2, foto3, prijs, Categorie)
VALUES
('gouden armband', 'Krachtige', 'foto/mannen-armband/9K-armband-met-gourmet-schakel-3,9mm1.avif', 'foto/mannen-armband/9K-armband-met-gourmet-schakel-3,9mm2.avif', 'foto/mannen-armband/9K-armband-met-gourmet-schakel-3,9mm3.avif', 1299.99, 'armband'),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),
('Laptop', 'Krachtige', 'laptop1', 'laptop2', 'laptop3', 1299.99),

