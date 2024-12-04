<?php
include('../modele/utilisateurModele.php');
include('../bdd/connexion.php');

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
            header("Location: ../index.php?error=invalid_action");
            exit;
    }
}

class UtilisateurController
{
    private $utilisateur;

    public function __construct($bdd)
    {
        $this->utilisateur = new Utilisateur($bdd);
    }

    public function ajouter()
    {
        // Vérification des champs obligatoires
        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: ../vue/utilisateur/ajouterUtilisateur.php?error=missing_fields');
            exit;
        }

        // Ajout de l'utilisateur
        $result = $this->utilisateur->ajouterUtilisateur(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['password']
        );

        if ($result) {
            header('Location: ../vue/utilisateur/ajouterUtilisateur.php?success=1');
        } else {
            header('Location: ../vue/utilisateur/ajouterUtilisateur.php?error=email_taken');
        }
    }

    public function connexion()
    {
        // Vérification des champs obligatoires
        if (empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: ../vue/utilisateur/login.php?error=missing_fields');
            exit;
        }

        // Vérification des informations d'identification
        $user = $this->utilisateur->connexionUtilisateur($_POST['email']);

        if ($user && password_verify($_POST['password'], $user['mot_de_passe'])) {
            session_start();
            $_SESSION['user'] = [
                'id_utilisateur' => $user['id_utilisateur'],
                'nom' => $user['nom'],
                'email' => $user['email'],
                'type' => $user['type']
            ];
            header('Location: ../index.php');
        } else {
            header('Location: ../vue/utilisateur/login.php?error=invalid_credentials');
        }
    }
}
?>
