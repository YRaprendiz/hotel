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

CREATE TABLE `type_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `info_supplementaires` text DEFAULT NULL COMMENT 'telephone;adress;ville;code postal.',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`type`) REFERENCES `type_user` (`id`) );

CREATE TABLE `voiture` (
  `id` int(11) NOT NULL,
  `modele` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` longblob NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `chambres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `image` longblob NOT NULL,
  `description` text NOT NULL,
  `prix_nuit` decimal(10,2) NOT NULL,
  `quantite` int(10) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `reservations_chambre` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `email_user` varchar(250) NOT NULL,
  `chambre_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `nb` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),  ADD UNIQUE KEY `user` (`user`),
  FOREIGN KEY (`chambre_id`) REFERENCES `chambres` (`id`) );

CREATE TABLE `reservations_voiture` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `email_user` varchar(250) NOT NULL,
  `voiture_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `nb` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user`) REFERENCES `user` (`id`) ,
  FOREIGN KEY (`voiture_id`) REFERENCES `voiture` (`id`));

CREATE TABLE `media_chambre` (
  `id` int(11) NOT NULL,
  `image` longblob DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id`) REFERENCES `chambres` (`id`) );

chambreControler.php
<?php
include ("../vue/listeChambre.php");
include ("../modele/chambreModele.php");
include ("../vue/detailsChambre.php");

if (isset($_GET['id'])) {
    $chambre = getChambreById($_GET['id']);
    include "../vue/detailsChambre.php";
} else {
    $listeChambre = getListeChambre();
    include "../vue/listeChambre.php";
}
