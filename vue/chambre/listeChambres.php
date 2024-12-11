<?php include('./vue/communs/header.php'); ?>

<div class="container my-5">
    <h1 class="mb-4">Nos Chambres Disponibles</h1>
    <div class="row">
        <?php if (!empty($chambres)): ?>
            <?php foreach ($chambres as $chambre): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="public/images/<?= htmlspecialchars($chambre['image'] ?? 'default_room.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($chambre['chambres_type']) ?>"> 
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($chambre['chambres_type']) ?></h5> 
                            <p class="card-text">Prix : <?= htmlspecialchars($chambre['prix']) ?> € / nuit</p>
                            <a href="index.php?page=detailsChambre&id=<?= $chambre['id_chambre'] ?>" class="btn btn-primary">Voir les détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune chambre disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</div>

<?php include('./vue/communs/footer.php'); ?>
