<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hotel</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    </div>
    <?php include("./vue/commun/header.php"); ?>

    
    <?php
    //system de routing

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

switch ($page) {
    case 'inscription':
        include('vue/inscription.php');
        break;
        
    case 'login':
        include('vue/login.php');
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
