-- Création de la base de données
CREATE DATABASE IF NOT EXISTS hc;
-- Création de la table des rôles
CREATE TABLE IF NOT EXISTS roles (
    id_roles  INT AUTO_INCREMENT PRIMARY KEY,
    typ VARCHAR(50) NOT NULL
);
-- Insérer des rôles par défaut
INSERT INTO roles (typ) VALUES ('client'), ('admin');

-- Création de la table des utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    adresse TEXT,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    FOREIGN KEY (role_id) REFERENCES roles(id_roles) ON DELETE CASCADE,
);

-- Création de la table des chambres
CREATE TABLE IF NOT EXISTS chambres (
    id_chambre INT AUTO_INCREMENT PRIMARY KEY,
    chambres_number VARCHAR(50) NOT NULL,
    chambres_type VARCHAR(100) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    status ENUM('available', 'booked', 'maintenance') NOT NULL,
    description TEXT,
    image VARCHAR(255), -- Vous pouvez ajouter une image pour chaque chambre
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table des messages de contact
CREATE TABLE IF NOT EXISTS contacts (
    id_contacts INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des réservations (facultative, si vous souhaitez gérer les réservations)
CREATE TABLE IF NOT EXISTS reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_chambre INT NOT NULL,
    id_user INT NOT NULL,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_arrivee DATE NOT NULL,
    date_depart DATE NOT NULL,
    FOREIGN KEY (chambre_id) REFERENCES chambres(id_chambre) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id_user) ON DELETE CASCADE
);
