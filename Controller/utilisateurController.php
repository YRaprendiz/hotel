<?php
session_start();
include('../model/utilisateurModel.php');
include('../bdd/connexion.php');


if (isset($_POST['action'])) {
    $utilisateurController = new UtilisateurController($connexion);

    switch ($_POST['action']) {
        case 'ajouter':
            $utilisateurController->create();
            break;
        case 'supprimer':
            $utilisateurController->delete();
            break;
        case 'connexion':
            $utilisateurController->connexion();
            break;
        case 'inscription':
            $utilisateurController->inscription();
            break;
        default:
            exit; // Action non reconnue
    }
}

class UtilisateurController
{
    private $utilisateur;

    public function __construct($connexion)
    {
        $this->utilisateur = new Utilisateur($connexion);
    }

    public function inscription()
    {
        // Vérification des champs obligatoires
        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: ../vue/utilisateur/inscription.php?error=missing_fields');
            exit;
        }

        // Ajout de l'utilisateur
        $result = $this->utilisateur->ajouterUtilisateur(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['password'],
            $_POST['telephone']
        );

        //var_dump($result);
        //die();

        if ($result) {
            header('Location: ../vue/utilisateur/inscription.php?success=1');
            exit;
        } else {
            header('Location: ../vue/utilisateur/inscription.php?error=email_taken');
            exit;
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
        $user = $this->utilisateur->connexionUtilisateur($_POST['email'], $_POST['password']);
/** var_dump($user);
    *die();
    *var_dump($_POST['password']);
    *var_dump($user['password']);
    *var_dump($_POST['password'] == $user['password']);
    *die;*/

        if ($user) {
            // Stockage des informations dans la session
            $_SESSION['user'] = [
                'id_utilisateur' => $user['id_utilisateur'],
                'nom' => $user['nom'],
                'email' => $user['email'],
                'type' => $user['type'] ?? 'utilisateur' // Type par défaut si absent
            ];
            header('Location: ../index.php'); // Redirection après connexion réussie
        } else {
            header('Location: ../vue/utilisateur/login.php?error=invalid_credentials');
            exit;
        }
    }
    
}
?>
