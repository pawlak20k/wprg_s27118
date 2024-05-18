CREATE DATABASE mojaBaza;
USE mojaBaza;

CREATE TABLE samochody (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marka VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    cena DECIMAL(10, 2) NOT NULL,
    rok INT NOT NULL,
    opis TEXT NOT NULL
);

SELECT * FROM mojaBaza.samochody;