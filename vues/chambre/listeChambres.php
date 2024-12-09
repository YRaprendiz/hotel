<?php include('./vues/communs/header.php'); ?>
<div class="container">
    <h2>Nos Chambres</h2>
    <div class="row">
        <?php foreach ($chambres as $chambre): ?>
            <div class="col">
                <div class="card">
                    <img src="public/images/<?= $chambre['image'] ?>" alt="Chambre">
                    <h3><?= htmlspecialchars($chambre['chambre_type']) ?></h3>
                    <p>Prix : <?= $chambre['prix'] ?> € / nuit</p>
                    <a href="index.php?page=detailsChambre&id=<?= $chambre['id_chambre'] ?>">Voir détails</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include('vues/communs/footer.php'); ?>
