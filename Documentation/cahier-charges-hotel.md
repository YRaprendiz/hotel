# Cahier des Charges - Système de Gestion Hôtelière
## "HotelManager Pro"

### 1. PRÉSENTATION DU PROJET

**Objectif** : Développer une application web complète de gestion hôtelière permettant la gestion des réservations, des chambres, des services et du personnel.

**Durée du projet** : 8 semaines
**Date de début** : À définir
**Date de fin** : À définir

### 2. ÉQUIPE ET RESPONSABILITÉS

#### William (Front-end & UI/UX)
- Interface utilisateur complète
- Intégration des designs
- Interactions client
- Tests utilisateur
- Documentation utilisateur

#### Suleiman (Back-end & Base de données)
- Architecture serveur
- Base de données
- API REST
- Sécurité
- Documentation technique

### 3. PLANNING DÉTAILLÉ

#### Semaine 1-2 : Initialisation
**William**
- Maquettes des interfaces principales
- Structure HTML/CSS de base
- Intégration de Bootstrap
- Design responsive

**Suleiman**
- Configuration du serveur
- Création de la base de données
- Mise en place de l architecture MVC
- Configuration sécurité de base

#### Semaine 3-4 : Fonctionnalités de Base
**William**
- Interface de réservation
- Système d authentification (front)
- Catalogue des chambres
- Formulaires de contact

**Suleiman**
- Système d authentification (back)
- Gestion des utilisateurs
- API de réservation
- Gestion des chambres

#### Semaine 5-6 : Fonctionnalités Avancées
**William**
- Interface de room service
- Système de paiement (front)
- Tableau de bord client
- Système de notifications

**Suleiman**
- API room service
- Intégration paiement
- Gestion des commandes
- Système de notifications (back)

#### Semaine 7-8 : Finalisation
**William**
- Tests d interface
- Corrections bugs UI
- Documentation utilisateur
- Formation client

**Suleiman**
- Tests d intégration
- Sécurisation finale
- Documentation technique
- Déploiement

### 4. SPÉCIFICATIONS TECHNIQUES

#### Technologies Front-end (William)
- HTML5/CSS3
- JavaScript ES6+
- Bootstrap 5
- Vue.js (optionnel)
- jQuery
- AJAX pour les appels API

#### Technologies Back-end (Suleiman)
- PHP 8.0+
- MySQL
- PDO
- Apache
- API REST
- JSON

### 5. FONCTIONNALITÉS À DÉVELOPPER

#### Interface Client (William)
1. **Système de Réservation**
   - Recherche de chambres
   - Calendrier de disponibilité
   - Formulaire de réservation
   - Paiement en ligne

2. **Espace Client**
   - Profil utilisateur
   - Historique des réservations
   - Gestion des préférences
   - Commandes room service

3. **Room Service**
   - Catalogue des produits
   - Panier de commande
   - Suivi de commande
   - Historique

#### Système Administration (Suleiman)
1. **Gestion des Chambres**
   - CRUD des chambres
   - Gestion des disponibilités
   - Tarification
   - Photos et descriptions

2. **Gestion des Réservations**
   - Vue d ensemble
   - Modification/Annulation
   - Facturation
   - Statistiques

3. **Gestion des Services**
   - Room service
   - Services supplémentaires
   - Tarification
   - Stock

### 6. LIVRABLES ATTENDUS

#### William
1. Interface utilisateur complète et responsive
2. Documentation utilisateur
3. Guide d utilisation
4. Rapports de tests UI

#### Suleiman
1. Base de données complète
2. API documentée
3. Documentation technique
4. Scripts de déploiement

### 7. CRITÈRES DE RÉUSSITE

1. **Performance**
   - Temps de chargement < 3s
   - Responsive sur tous supports
   - Compatible tous navigateurs modernes

2. **Sécurité**
   - Authentification robuste
   - Protection contre les injections SQL
   - Validation des données
   - HTTPS

3. **Fonctionnel**
   - Réservation sans erreur
   - Paiement sécurisé
   - Gestion correcte des disponibilités
   - Notifications en temps réel

### 8. MAINTENANCE ET SUPPORT

- Période de garantie : 3 mois
- Support technique : Email & Téléphone
- Mises à jour de sécurité
- Corrections de bugs

### 9. ANNEXES

- Maquettes UI/UX
- Schéma de base de données
- Documentation API
- Guide de style


=====================================================================================================

### Documentation du projet "Site Hôtel"  

---

### **1. Réalisation de deux situations professionnelles**

#### Client Léger : PHP - MySQL - HTML - CSS - JS  
Développement d un site web dynamique pour la gestion des réservations hôtelières avec une interface intuitive et responsive.  

#### Client Mobile : Android, Web Service JSON, MySQL, PHP  
Création d une application mobile connectée au site pour permettre aux clients de gérer leurs réservations depuis leur smartphone.

---

### **2. Construction du Contexte Professionnel**  

#### **Le Client (Exemple : Hôtel Horizon)**  
- **Identité :** Hôtel Horizon, spécialisé dans l accueil de touristes et professionnels.  
- **Historique :** Créé en 1998, cet hôtel a su évoluer avec les besoins des clients, intégrant des services numériques depuis 2015.  
- **Activités/Produits :** Hébergement, location de salles de conférence, restauration.  
- **Organigramme :**  
  Directeur général → Responsable des services → Réceptionnistes → Équipe technique.  
- **Infrastructure réseau :** Réseau local avec un serveur principal pour gérer les réservations, connectivité internet via fibre optique.  
- **Chiffre d affaires :** 3,2 millions d euros (source : societe.com).  
- **Partenaires socio-économiques :** Agences de voyage, prestataires de services locaux, entreprises de location de véhicules.  
- **Perspectives d avenir :** Digitalisation complète des services et élargissement à une chaîne hôtelière.  

#### **Le Prestataire (Exemple : WebTech Solutions)**  
- **Identité :** WebTech Solutions, société de services numériques spécialisée dans le développement d applications web et mobiles.  
- **Domaines d activités informatiques :**  
  - Développement d applications web.  
  - Maintenance de systèmes informatiques.  
  - Développement mobile.  
- **Offres commerciales :** Création de sites personnalisés, hébergement, support technique.  
- **Chiffres clés :** 15 employés, 1,8 million d euros de chiffre d affaires annuel.  

---

### **3. Cahier des charges**

- **Objectifs :**  
  Offrir une solution complète pour la gestion des chambres, des réservations, et des profils utilisateurs, avec des accès différenciés pour les clients et les administrateurs.  

- **Publics cibles :**  
  - Clients souhaitant réserver des chambres en ligne.  
  - Administrateurs responsables de la gestion interne.  

- **Maquettes :** Présentation des maquettes réalisées avec Figma, illustrant les interfaces utilisateur.  

- **Architecture du site :**  
  - **Backend :** PHP et MySQL.  
  - **Frontend :** HTML, CSS, JS.  
  - **Architecture MVC :**  
    - Modèles : Gestion des données (MySQL).  
    - Vues : Affichage des pages (HTML/CSS/JS).  
    - Contrôleurs : Logique métier (PHP).  

- **Technologies utilisées :**  
  - Frameworks : Bootstrap (CSS), jQuery (JS).  
  - Serveur local : XAMPP.  

- **Contraintes de temps et de budget :**  
  - Temps : 3 mois.  
  - Budget : 5 000 €.  

- **Planning de réalisation :**  
  - Phase 1 : Analyse des besoins (1 semaine).  
  - Phase 2 : Conception (2 semaines).  
  - Phase 3 : Développement (2 mois).  
  - Phase 4 : Tests et déploiement (1 semaine).  

---

### **4. Documentation Technique**

- **MCD - MLDR :**  
  Schémas de base de données représentant les tables `users`, `rooms`, `reservations`.  

- **Diagramme de cas d utilisation :**  
  - Réserver une chambre.  
  - Ajouter une chambre (administrateur).  
  - Consulter les réservations.  

- **Charte graphique :**  
  - Couleurs principales : Bleu (#0044cc), Blanc (#ffffff).  
  - Polices : Open Sans pour le texte, Roboto pour les titres.  

- **Map du site :**  
  - Accueil.  
  - Connexion/Inscription.  
  - Liste des chambres.  
  - Réservations.  
  - Tableau de bord administrateur.  

---

### **5. Documentation Utilisateur**

- **Copies d écrans avec explication :**  
  - Écran d accueil : Présente les options principales.  
  - Formulaire de connexion : Champ pour email et mot de passe.  
  - Tableau de bord administrateur : Vue centralisée pour gérer les données.  

---

### **6. Documentation des incidents**

- **Exemples d incidents rencontrés :**  
  - **Bug :** Problème de connexion utilisateur.  
    - **Solution :** Reconfiguré le middleware d authentification.  
  - **Bug :** Page blanche après soumission du formulaire.  
    - **Solution :** Debugging et correction des erreurs PHP avec `error_log`.  

---

### **7. Documentation juridique**

- **Mentions légales :**  
  Propriété intellectuelle, protection des données.  

- **CNIL :**  
  Déclaration de conformité pour la collecte des données personnelles.  

- **RGPD :**  
  Mise en place d un consentement utilisateur pour les cookies et la gestion des données.  

---

### **8. Documentation financière**

- **Budget de réalisation :**  
  - Analyse et conception : 1 500 €.  
  - Développement : 2 500 €.  
  - Tests et déploiement : 1 000 €.  

---

### **9. Développement Web**

- Développement basé sur les principes MVC.  
- Utilisation de requêtes SQL optimisées pour MySQL.  
- Scripts JS pour améliorer l expérience utilisateur.  

---

Ce document fournit une vue complète du projet hôtel, de la conception à la documentation finale.