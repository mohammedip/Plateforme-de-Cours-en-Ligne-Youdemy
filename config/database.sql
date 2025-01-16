-- Active: 1736613010455@@127.0.0.1@3306
DROP DATABASE if EXISTS youdemy_db;

CREATE DATABASE youdemy_db;

use youdemy_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    bio TEXT,
    profil_img_url VARCHAR(255),
    role ENUM('Admin', 'Enseignant', 'Etudiant') NOT NULL,
    statutCompte ENUM('suspension', 'activation') NOT NULL DEFAULT 'activation',
    validCompte ENUM('valide', 'non valide') NOT NULL DEFAULT 'valide'
);

CREATE TABLE Categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE Tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE Cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    contenu TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    enseignant_id INT,
    category_id INT,
    FOREIGN KEY (enseignant_id) REFERENCES Utilisateur(id) ON DELETE SET NULL,
    FOREIGN KEY (category_id) REFERENCES Category(id) ON DELETE SET NULL
);

CREATE TABLE Cours_Tag (
    cours_id INT,
    tag_id INT,
    PRIMARY KEY (cours_id, tag_id),
    FOREIGN KEY (cours_id) REFERENCES Cours(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES Tag(id) ON DELETE CASCADE
);

CREATE TABLE Cours_Etudiant (
    cours_id INT,
    etudiant_id INT,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP, 
    status ENUM('complet', 'non complet') NOT NULL DEFAULT 'non complet',
    PRIMARY KEY (cours_id, etudiant_id),
    FOREIGN KEY (cours_id) REFERENCES Cours(id) ON DELETE CASCADE,
    FOREIGN KEY (etudiant_id) REFERENCES Utilisateur(id) ON DELETE CASCADE
);

 