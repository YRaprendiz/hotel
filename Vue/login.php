<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include("../vue/commun/header.php"); ?>

    <div class="login-page">
        <div class="form">
            <form class="login-form" method="POST" action="../controleur/UtilisateurControleur.php">
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Mot de passe" required />
                <button type="submit" name="action" value="connexion">Se connecter</button>
                <i class="message">Pas encore inscrit ? <a href="./utilisateur/ajouterUtilisateur.php">Créez un compte</a></i>
            </form>
        </div>
    </div>

    <?php
    // Affichage des messages d'erreur ou de succès
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'fields') {
            echo "<div class='msg'><p style='color: yellow;'>Tous les champs sont obligatoires !</p></div>";
        } elseif ($_GET['error'] == 'wrong_credentials') {
            echo "<div class='msg'><p style='color: yellow;'>Identifiants incorrects !</p></div>";
        }
    }
    ?>

    <?php include("../vue/commun/footer.php"); ?>
</body>
</html>
