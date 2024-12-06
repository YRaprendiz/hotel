<?php include("./vue/commun/header.php"); ?>

<?php
// Récupération du paramètre 'page' dans l'URL, valeur par défaut : 'accueil'
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

switch ($page) {
    case 'inscription':
        include('vue/utilisateur/inscription.php');
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
        include('vue/accueil.php');
        break;
}
?>

<?php include("./vue/commun/footer.php"); ?>