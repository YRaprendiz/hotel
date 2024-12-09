<?php
session_start();
include('./bdd/connexion.php');
include('./modele/utilisateurModele.php');
include('./authController.php');


if (isset($_POST['action'])) {
    $utilisateurController = new UtilisateurController($connexion_hc);

    switch ($_POST['action']) {
        case 'ajouter':
            $utilisateurController->();
            break;
        case 'connexion':
            $utilisateurController->connexion_hc();
            break;
        case 'register':
            $utilisateurController->();
            break;
        default:
            exit; // Action non reconnue
    }
}

class UtilisateurController
{
    private $utilisateur;

    public function __construct($connexion_hc)
    {
        $this->utilisateur = new Utilisateur($connexion_hc);
    }

    public function inscription()
    {
        // Vérification des champs obligatoires
        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: ../vue/utilisateur/inscription.php?error=missing_fields');
            exit;
        }

        // Ajout de l'utilisateur
        $result = $this->utilisateur->register(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['pass'],
            $_POST['adress']
        );

        //var_dump($result);
        //die();

        if ($result) {
            header('Location: ../vue/utilisateur/register.php?success=1');
            echo('incription reussi ! !');
            exit;
        } else {
            header('Location: ../vue/utilisateur/register.php?error=email_taken');
            exit;
        }
    }

    public function connexion_hc()
    {
        // Vérification des champs obligatoires
        if (empty($_POST['email']) || empty($_POST['pass'])) {
            header('Location: ../vue/utilisateur/login.php?error=missing_fields');
            exit;
        }

        // Vérification des informations d'identification
        $user = $this->utilisateur->login($_POST['email'],$_POST['pass']);
        var_dump($user);
        die();

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