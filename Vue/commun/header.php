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
            <a href="index.php?page=chambres">Chambres</a>
            <a href="index.php?page=contact">Contact</a>
            <?php if (isset($_SESSION['utilisateur'])): ?>
                <a href="index.php?page=profil">Mon Profil</a>
                <a href="index.php?page=reservation">Réservations</a>
                <a href="index.php?page=deconnexion">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?page=inscription">Inscription</a>
                <a href="index.php?page=login">Connexion</a>
            <?php endif; ?>
        </ul>
    </nav>
