<?php
// controllers/AuthController.php
session_start();
require_once '../config/database.php';
require_once './User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $hotel_chat = new hotel_chat();
        $this->db = $hotel_chat->getConnection();
        $this->user = new User($this->db);
    }

    // Inscription
    public function register($dados) {
        $this->user->nom = $dados['nom'];
        $this->user->prenom = $dados['prenom'];
        $this->user->email = $dados['email'];
        $this->user->pass = $dados['pass'];
        $this->user->adress = $dados['adress'];
        $this->user->role = 'client'; // Par défaut, les nouveaux utilisateurs sont des clients

        if($this->user->register()) {
            // Redirection vers la page de connexion
            header("Location: login.php?register=success");
            exit();
        } else {
            return "Erreur lors de l'inscription";
        }
    }

    // Connexion
    public function login($email, $pass) {
        $user = $this->user->login($email, $pass);

        if($user) {
            // Connexion réussie
            $_SESSION['user_id_utilisateur'] = $user['id_utilisateur'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role_id'] = $user['role_id'];

            // Redirection selon le rôle
            if($user['role_id'] == 'admin') {
                header("Location: users-list.php");
            } else {
                header("Location: profile.php");
            }
            exit();
        } else {
            return "Email ou mot de passe incorrect";
        }
    }

    // Déconnexion
    public function logout() {
        // Détruire la session
        session_unset();
        session_destroy();

        // Redirection vers la page d'accueil
        header("Location: home.php");
        exit();
    }

    // Vérifier si l'utilisateur est connecté
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Vérifier si l'utilisateur est un admin
    public static function isAdmin() {
        return isset($_SESSION['user_role_id']) && $_SESSION['user_role_id'] == 'admin';
    }
}