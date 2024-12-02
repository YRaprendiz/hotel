<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hotel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>        
        <ul>
            <a href="index.php">Accueil</a>
            <a href="index.php?route=chambres">Chambres</a>
            <a href="index.php?route=contact">Contact</a>
            <?php if (isset($_SESSION['utilisateur'])): echo $_SESSION['utilisateur']['prenom'] . " " . $_SESSION['utilisateur']['nom']?>
                <a href="index.php?route=profil">Mon Profil</a>
                <a href="index.php?route=reservation">Réservations</a>
                <a href="index.php?route=deconnexion">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?route=utilisateur/ajouterUtilisateur">Login</a>
            <?php endif; ?>
        </ul>
    </nav>