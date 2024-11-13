<?php
include "../bdd/connexion.php";
include "../modele/mainModele.php";
include "../vue/header.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

switch ($page) {
    case 'index':
        include "../vue/index.php";
        break;
    case 'chambre':
        include "../controleur/chambreControleur.php";
        break;
    default:
        include "../vue/index.php";
        break;
}

include "../vue/footer.php";
?>
