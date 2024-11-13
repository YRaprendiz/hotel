<?php
// Inclure les fichiers nécessaires
include('model/utilisateurModel.php');
include('bdd/connexion.php');

// Récupérer l'ID de l'utilisateur à partir de l'URL
$idUtilisateur = $_GET['id'];

// Récupérer les informations de l'utilisateur
$utilisateur = new Utilisateur($bdd);
$detailUtilisateur = $utilisateur->getUtilisateurById($idUtilisateur);

// Vérifier si l'utilisateur est un administrateur
// Remplacer cette condition par un système de gestion de session pour les admins.
session_start();
$isAdmin = isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Détails de l'utilisateur</h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <?php if ($isAdmin) { ?>
                    <th scope="col">Actions</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?php echo $detailUtilisateur['id']; ?></th>
                <td><?php echo $detailUtilisateur['nom']; ?></td>
                <td><?php echo $detailUtilisateur['prenom']; ?></td>
                <td><?php echo $detailUtilisateur['email']; ?></td>
                <?php if ($isAdmin) { ?>
                    <td>
                        <form action="controller/utilisateurController.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            <input type="hidden" name="action" value="supprimer">
                            <input type="hidden" name="idUtilisateur" value="<?php echo $detailUtilisateur['id']; ?>">
                            <input type="submit" value="Supprimer" class="btn btn-danger">
                        </form>
                    </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>

    <?php if ($isAdmin) { ?>
        <a href="modifierUtilisateur.php?id=<?php echo $detailUtilisateur['id']; ?>" class="btn btn-warning">Modifier</a>
    <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
