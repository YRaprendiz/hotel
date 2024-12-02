<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Ajouter un Utilisateur</h1>

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
    </form>
</body>
</html>
