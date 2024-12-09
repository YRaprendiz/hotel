//listechambre.php
<?php include('views/communs/header.php'); ?>

<div class="container my-5">
    <h1 class="mb-4">Nos Chambres Disponibles</h1>
    <div class="row">
        <?php if (!empty($chambres)): ?>
            <?php foreach ($chambres as $chambre): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if (!empty($chambre['image'])): ?>
                            <img src="public/images/<?= htmlspecialchars($chambre['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($chambre['chambres_type']) ?>">
                        <?php else: ?>
                            <img src="public/images/default_room.jpg" class="card-img-top" alt="Image par défaut">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($chambre['chambres_type']) ?></h5>
                            <p class="card-text"><strong>Prix :</strong> <?= htmlspecialchars($chambre['prix']) ?> € / nuit</p>
                            <p class="card-text"><strong>Status :</strong> 
                                <?= $chambre['status'] === 'available' ? 'Disponible' : ($chambre['status'] === 'booked' ? 'Réservée' : 'En maintenance') ?>
                            </p>
                            <a href="index.php?page=detailsChambre&id=<?= $chambre['id_chambre'] ?>" class="btn btn-primary">Voir les détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Aucune chambre disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</div>


<?php include('views/communs/footer.php'); ?>
