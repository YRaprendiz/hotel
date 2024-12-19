<!-- UtilisateurController.php -->
<?php

include_once('./models/UtilisateurModel.php');

class UtilisateurController {
    
    private $model;
    
    public function __construct() {
        $this->model = new UtilisateurModel((new BaseModel())->bdd);
    } 

    public function login($email, $pass) {
        $user = $this->model->login($email, $pass);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];
            $this->setFlashMessage('success', 'Connexion réussie. Bienvenue ' . htmlspecialchars($user['prenom']) . ' !');
            header('Location: index.php?page=profile');
            exit;
        } else {
            $this->setFlashMessage('error', 'Identifiants invalides.');
            header('Location: index.php?page=login');
            exit;
        }
    }

    public function getLoggedUser() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            return $this->model->getUserById($_SESSION['user_id']);
        }
        return null;
    }



    public function register($data) {
        if ($this->model->register($data['nom'], $data['prenom'], $data['email'], $data['pass'], $data['adresse'])) {
            $this->setFlashMessage('success', 'Inscription réussie. Veuillez vous connecter.');
            header('Location: index.php?page=login');
            exit;
        } else {
            $this->setFlashMessage('error', 'Erreur lors de l\'inscription. Veuillez réessayer.');
            header('Location: index.php?page=register');
            exit;
        }
    }
    protected function setFlashMessage($type, $message) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

}
?>