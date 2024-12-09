<?php include('vues/communs/header.php'); ?>
<div class="container">
    <h2>Détails de la Chambre</h2>
    <?php if ($chambre): ?>
        <div class="card">
            <img src="public/images/<?= $chambre['image'] ?>" alt="Chambre">
            <h3><?= htmlspecialchars($chambre['chambre_type']) ?></h3>
            <p>Description : <?= htmlspecialchars($chambre['description']) ?></p>
            <p>Prix : <?= $chambre['prix'] ?> € / nuit</p>
        </div>
    <?php else: ?>
        <p>Chambre non trouvée.</p>
    <?php endif; ?>
</div>
<?php include('vues/communs/footer.php'); ?>
