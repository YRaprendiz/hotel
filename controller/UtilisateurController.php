<!-- UtilisateurController.php -->
<?php
include_once('./bdd/connexion.php');
include_once('./model/UtilisateurModel.php');

class UtilisateurController {
    protected function setFlashMessage($type, $message) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    private $model;

    public function __construct() {
        $this->model = new UtilisateurModel();
    }

    public function login($email, $password) {
        $user = $this->model->login($email, $password);
        if ($user) {
            session_start();
            $_SESSION['id_utilisateur'] = $user;
            $this->setFlashMessage('success', 'Connexion réussie. Bienvenue ' . htmlspecialchars($user['nom']) . ' !');
            header('Location: index.php?page=profile');
            exit;
        } else {
            $this->setFlashMessage('error', 'Identifiants invalides.');
            header('Location: index.php?page=login');
            exit;
        }
    }

    public function register($data) {
        if ($this->model->register($data['nom'], $data['prenom'], $data['email'], $data['password'], $data['adresse'])) {
            $this->setFlashMessage('success', 'Inscription réussie. Veuillez vous connecter.');
            header('Location: index.php?page=login');
            exit;
        } else {
            $this->setFlashMessage('error', 'Erreur lors de l\'inscription. Veuillez réessayer.');
            header('Location: index.php?page=register');
            exit;
        }
    }
}
?>