
    <?php include("./vue/commun/header.php"); ?>

    
    <?php
    //system de routing

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

switch ($page) {
    case 'inscription':
        include('vue/utilisateur/inscription.php');
        break;
        
    case 'login':
        include('vue/utilisateur/login.php');
        break;

    case 'chambres':        // Ta logique pour afficher les chambres
        include('vue/chambre/listeChambres.php');
        break;
    
    case 'contact':
        include('vue/contact.php');
        break;



        

    default:
        include('vue/accueil.php');
        break;
}
    ?>

    <?php include("./vue/commun/footer.php"); ?>


</body>
</html>
