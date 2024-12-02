<?php
include('../modele/utilisateurModele.php');
include("../bdd/connexion.php");

if (isset($_POST['action'])) {

    $utilisateurController = new UtilisateurController($bdd);

    switch ($_POST['action']) {

        case 'ajouter':
            $utilisateurController->ajouter();
            break;

        case 'connexion':
            $utilisateurController->connexion();
            break;

        default:
            // Aucune action correspondante
            break;
    }
}

class UtilisateurController
{
    private $utilisateur;

    function __construct($bdd)
    {
        $this->utilisateur = new Utilisateur($bdd);
    }

    public function ajouter()
    {
        // Vérification des champs
        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: http://127.0.0.1/hotel/vue/utilisateur/ajouterUtilisateur.php?error=1');
            exit;
        }

        // Ajouter l'utilisateur
        $result = $this->utilisateur->ajouterUtilisateur(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['password']
        );

        if ($result) {
            header('Location: http://127.0.0.1/hotel/vue/utilisateur/ajouterUtilisateur.php?success=1');
        } else {
            header('Location: http://127.0.0.1/hotel/vue/utilisateur/ajouterUtilisateur.php?error=2');
        }
    }
    public function connexion()
    {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            header("Location: ../vue/utilisateur/login.php?error=fields");
            exit;
        }

        // Vérification de l'existence de l'utilisateur
        $stmt = $this->utilisateur->connexionUtilisateur($_POST['email']);
        $user = $stmt->fetch();

        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: ../index.php");
        } else {
            header("Location: ../vue/utilisateur/login.php?error=wrong_credentials");
        }
    }
}
?>
