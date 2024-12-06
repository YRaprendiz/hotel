<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Inscription</h2>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php
                    if ($_GET['error'] == 'missing_fields') {
                        echo "Tous les champs sont requis.";
                    } elseif ($_GET['error'] == 'email_taken') {
                        echo "Cet email est déjà utilisé.";
                    }
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">
                Inscription réussie ! Vous pouvez maintenant vous connecter.
            </div>
        <?php endif; ?>
        
        <form action="../controller/utilisateurcontroller.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="telephone">Numéro de téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone">
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="inscription">S'inscrire</button>
        </form>
        
        <p class="mt-3">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
