<?php
// Fichier principal de routage
session_start();
include("./bdd/connexion.php");
include("./controller/authController.php");

// Redirection vers la page appropriée
if (AuthController::isLoggedIn()) {
    if (AuthController::isAdmin()) {
        header("Location: users-list.php");
    } else {
        header("Location: profile.php");
    }
} else {
    header("Location: home.php");
}
exit();
?>
<?php include("./vue/commun/header.php"); ?>

<?php
// Système de routage simple pour naviguer entre les pages

// Récupération du paramètre 'page' dans l'URL, valeur par défaut : 'accueil'
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

switch ($page) {
    case 'resgister':
        include('vue/utilisateur/resgister.php');
        break;

    case 'login':
        include('vue/utilisateur/login.php');
        break;

    case 'chambres':
        // Liste des chambres (ou toute autre logique associée)
        include('vue/chambre/listeChambres.php');
        /**if (isset($_SESSION['utilisateur'])) {
        *include('vue/chambre/listeChambres.php');
        *} else {
        *    header('Location: index.php?page=login');
        *    exit;
        } */
        break;

    case 'contact':
        include('vue/contact.php');
        break;

    case 'reservation':
        include('vue/reservation/listeReservations.php');
        break;
        

    default:
        include('vue/home.php');
        break;
}
?>

<?php include("./vue/commun/footer.php"); ?>
