<?php
include('../../bdd/connexion.php');
include('./controllers/ChambreController.php');

$controller = new ChambreController($bdd);
$chambres = $controller->list();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Liste des Chambres</title>
</head>
<body>
    <h1>Liste des Chambres</h1>
    <div class="row">
        <?php if (!empty($chambres)): ?>
            <?php foreach ($chambres as $chambre): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if (!empty($chambre['image'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($chambre['image']) ?>" class="card-img-top" alt="Image Chambre">
                        <?php else: ?>
                            <img src="../../assets/images/default.jpg" class="card-img-top" alt="Image par défaut">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($chambre['type']) ?></h5>
                            <p class="card-text">Chambre pour <?= htmlspecialchars($chambre['nb_max_chambre']) ?> personnes</p>
                            <p class="card-text">Prix par nuit : <?= htmlspecialchars($chambre['prix_nuit']) ?> €</p>
                            <p class="card-text">Services : Toilettes, Lit, Localisation, Parking, Wi-Fi, Déjeuner, Check-in et Check-out horaires</p>
                            <a href="detailsChambre.php?id=<?= $chambre['id_chambre'] ?>" class="btn btn-primary">Voir détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-danger">Aucune chambre disponible.</p>
        <?php endif; ?>
    </div>
</body>
</html>
