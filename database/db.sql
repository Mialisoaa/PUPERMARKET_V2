CREATE DATABASE supermarket; 
USE supermarket;

-- 1. Produits
-- a. Désignation
-- b. Prix
-- c. Quantité en stock
-- d. Etc…
-- 2. Caisse
-- 3. Achat

CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(255) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    quantite_en_stock INT NOT NULL
);

CREATE TABLE caisse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT NOT NULL,
    caisse_id INT NOT NULL,
    quantite INT NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produit_id) REFERENCES produits(id),
    FOREIGN KEY (caisse_id) REFERENCES caisse(id)
);


INSERT INTO produits (designation, prix, quantite_en_stock) VALUES 
('Lait', 6000, 50),
('Pain', 600, 100),
('Oeufs', 700, 200),
('Beurre', 4500, 40),
('Fromage', 8000, 30);

INSERT INTO caisse (nom) VALUES 
('Caisse 1'),
('Caisse 2');



