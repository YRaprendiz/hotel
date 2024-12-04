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
<div><h1>Ajouter un Utilisateur</h1>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 1) {
        echo "<div class='error'>Tous les champs sont obligatoires.</div>";
    } elseif ($_GET['error'] == 2) {
        echo "<div class='error'>Erreur lors de l'ajout de l'utilisateur.</div>";
    }
}

if (isset($_GET['success'])) {
    echo "<div class='success'>Utilisateur ajouté avec succès.</div>";
}
?>

<form action="../controleur/UtilisateurControleur.php" method="post">
    <input type="hidden" name="action" value="ajouter">
    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Ajouter</button>
</form></div>
    <?php include("../vue/commun/footer.php"); ?>
</body>
</html>
