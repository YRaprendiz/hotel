hi there this is youraprendiz and in here is suposed to be a project of an aplication web named hotel ;
Hotel/
├── bdd/
|   ├ Script #pour construir la base de donne
│   └── connexion.php #pour connecter le project hotela la base de donne
├── controleur/
│   ├── MainControleur.php
|   ├── UtilisateurControleur.php
│   └── ChambreControleur.php
├── modele/
│   ├── MainModele.php
│   ├── UtilisateurModele.php
│   └── ChambreModele.php
├── vue/
|    ├── vue/commun
|    |     ├── header.php #navbar pour les pages du site
|    |     └── footer.php #footer pour les pages du site
|    ├── detailsChambre.php
|    └── reservationChambre.php
├──── Chambre.php
└──── index.php

it will interract whit  this mySQL;

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS hotelManager;

-- Sélection de la base de données
USE hotelManager;

-- Table des utilisateurs (Clients, Administrateurs)
CREATE TABLE IF NOT EXISTS utilisateurs (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'administrateur') DEFAULT 'client',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des chambres
CREATE TABLE IF NOT EXISTS chambres (
    id_chambre INT AUTO_INCREMENT PRIMARY KEY,
    numero_chambre VARCHAR(50) NOT NULL UNIQUE,
    type ENUM('simple', 'double', 'suite') NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    disponibilite BOOLEAN DEFAULT TRUE,  -- TRUE: chambre disponible, FALSE: chambre occupée
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des réservations
CREATE TABLE IF NOT EXISTS reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_chambre INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    statut ENUM('confirmée', 'annulée', 'en attente') DEFAULT 'en attente',
    montant DECIMAL(10, 2) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_chambre) REFERENCES chambres(id_chambre) ON DELETE CASCADE
);

-- Table des services (Room Service, extras, etc.)
CREATE TABLE IF NOT EXISTS services (
    id_service INT AUTO_INCREMENT PRIMARY KEY,
    nom_service VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des commandes de service (Room service, etc.)
CREATE TABLE IF NOT EXISTS commandes_services (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    id_reservation INT NOT NULL,
    id_service INT NOT NULL,
    quantite INT DEFAULT 1,
    statut ENUM('en cours', 'livré', 'annulé') DEFAULT 'en cours',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_reservation) REFERENCES reservations(id_reservation) ON DELETE CASCADE,
    FOREIGN KEY (id_service) REFERENCES services(id_service) ON DELETE CASCADE
);

-- Table des paiements
CREATE TABLE IF NOT EXISTS paiements (
    id_paiement INT AUTO_INCREMENT PRIMARY KEY,
    id_reservation INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    statut ENUM('payé', 'en attente', 'échoué') DEFAULT 'en attente',
    date_paiement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_reservation) REFERENCES reservations(id_reservation) ON DELETE CASCADE
);

-- Table pour les logs (facultatif mais utile pour la gestion et le support)
CREATE TABLE IF NOT EXISTS logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    type_log ENUM('erreur', 'info', 'avertissement') NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
