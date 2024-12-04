<?php
include_once('../../bdd/connexion.php');
include_once('../../controleur/chambreController.php');

if (!isset($_GET['id'])) {
    echo "<p class='text-danger'>ID de la chambre manquant.</p>";
    exit;
}

$controller = new ChambreController($bdd);
$chambre = $controller->afficherDetailsChambre($_GET['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Détails de la Chambre</title>
</head>
<body>
    <h1>Détails de la Chambre</h1>
    <?php if ($chambre): ?>
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
            </div>
        </div>
    <?php else: ?>
        <p class="text-danger">Chambre non trouvée.</p>
    <?php endif; ?>
</body>
</html>
